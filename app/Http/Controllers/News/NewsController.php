<?php

namespace App\Http\Controllers\News;

use App\Models\Tag;
use App\Models\News;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;
use Carbon\Carbon;

class NewsController extends Controller
{
    /**
     * Show news pages
     *
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        Carbon::setLocale('id');

        $recentNews = News::with('category', 'user')
            ->where('active', '1')
            ->latest()
            ->paginate(15);
        $trending = News::with('category', 'user')
            ->where('active', '1')
            ->orderBy('views', 'desc')
            ->paginate(15);
        $oldNews = News::with('category', 'user')
            ->where('active', '1')
            ->latest()
            ->paginate(8);
        $newsCategories = Category::with('news')
            ->whereHas('news', function ($query) {
                $query->where('active', 1);
            })
            ->orderBy('title')
            ->latest()
            ->get();
        $tags = Tag::with('news')
            ->whereHas('news', function ($query) {
                $query->where('active', 1);
            })
            ->orderBy('title')
            ->get();


        return view(
            'users.news.index',
            compact('recentNews', 'newsCategories', 'oldNews', 'tags', 'user', 'trending'),
        );
    }

    /**
     * Display single news.
     *
     * @param  $slug
     * @return Application|Factory|View
     */
    public function show($slug)
    {
        $user = Auth::user();
        $news = News::where('slug', $slug)
            ->with('category', 'comments', 'user')
            ->where('active', 1)
            ->latest()
            ->firstOrFail();

        $newsCategories = Category::with('news')
            ->whereHas('news', function ($query) {
                $query->where('active', 1);
            })
            ->orderBy('title')
            ->latest()
            ->get();
        $trending = News::with('category', 'user')
            ->where('active', '1')
            ->orderBy('views', 'desc')
            ->paginate(15);
        $tags = Tag::with('news')
            ->whereHas('news', function ($query) {
                $query->where('active', 1);
            })
            ->orderBy('title')
            ->latest()
            ->get();

        ++$news->views;
        $news->update();

        return view('users.news.news', compact('news', 'newsCategories', 'tags', 'user', 'trending'));
    }

    function nuNews($slug, Request $request)
    {
        $onPage = is_null($request->get('pages')) ? 2 : $request->get('pages');
        $res = Http::get('https://nuonline.cms.nu.or.id/api/v3/articles?lang=id&limit=2' . $onPage);
        $data['users'] = $res->json()['data'];

        $user = Auth::user();
        $news = collect($data['users'])
            ->where('slug', $slug)
            ->first();

        $id = $news['id'];
        $title = $news['title'];
        $url = $news['url'];
        $preview = $news['preview'];
        $category = $news['categories'];

        $full = $news['image']['full'];
        $author = $news['author'][1]['name'];

        $date = $news['date']['published'];

        // $news['views']++;
        // $news->save();

        // return  $full;

        return view(
            'users.news.news-nu',
            compact('news', 'user', 'full', 'title', 'preview', 'url', 'category', 'date', 'author', 'data'),
        );
    }
}
