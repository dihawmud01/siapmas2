<?php

namespace App\Http\Controllers\News;

use App\Models\Tag;
use App\Models\News;
use App\Models\Category;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;
use Carbon\Carbon;

class TagController extends Controller
{
    /**
     * Display tags.
     *
     * @param  $slug
     * @return Application|Factory|View
     */
    public function show($slug)
    {
        $user = Auth::user();

        $tag = Tag::with('news')
            ->where('slug', $slug)
            ->orderBy('title')
            ->firstOrFail();
        $tags = Tag::with('news')
            ->whereHas('news', function ($query) {
                $query->where('active', 1);
            })
            ->orderBy('title')
            ->get();

        $news = $tag
            ->news()
            ->with('category', 'user')
            ->where('active', '1')
            ->latest()
            ->paginate(4)
            ->map(function ($post) {
                $post->formatted_date = Carbon::parse($post->created_at)->format('d M Y H:i');

                return $post;
            });

        $newsCategories = Category::has('news')
            ->orderBy('title')
            ->latest()
            ->get();
        $trending = News::with('category', 'user')
            ->where('active', '1')
            ->orderBy('views', 'desc')
            ->paginate(15);

        return view('users.news.tags', compact('tag', 'tags', 'news', 'newsCategories', 'user', 'trending'));
    }
}
