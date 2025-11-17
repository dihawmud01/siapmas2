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

class CategoryController extends Controller
{
    /**
     * Display categories.
     *
     * @param  $slug
     * @return Application|Factory|View
     */
    public function show($slug)
    {
        $user = Auth::user();
        $category = Category::with('news')
            ->where('slug', $slug)
            ->whereHas('news', function ($query) {
                $query->where('active', 1);
            })
            ->orderBy('title')
            ->firstOrFail();
        $trending = News::with('category', 'user')
            ->where('active', '1')
            ->orderBy('views', 'desc')
            ->paginate(15);
        $newsCategories = Category::with('news')
            ->whereHas('news', function ($query) {
                $query->where('active', 1);
            })
            ->orderBy('title')
            ->latest()
            ->get();

        $news = $category
            ->news()
            ->with('category', 'user')
            ->where('active', '1')
            ->latest()
            ->paginate(10)
            ->map(function ($post) {
                $post->formatted_date = Carbon::parse($post->created_at)->format('d M Y H:i');

                return $post;
            });

        $tags = Tag::with('news')
            ->whereHas('news', function ($query) {
                $query->where('active', 1);
            })
            ->orderBy('title')
            ->get();

        return view('users.news.categories', compact('category', 'news', 'tags', 'newsCategories', 'user', 'trending'));
    }
}
