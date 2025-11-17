<?php

namespace App\Http\Controllers\News;

use App\Models\Tag;
use App\Models\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SearchRequest;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = new News();
        $search = $request->s;

        if ($search) {
            $query = News::with('categories', 'tags')
                ->where('title', 'like', "%$search%")
                ->where('active', 1);
        }

        $tags = Tag::with('news')
            ->whereHas('news', function ($query) {
                $query->where('active', 1);
            })
            ->orderBy('title')
            ->get();
        $search_results = $query->paginate(4);

        return view('news.search', compact('search', 'search_results', 'tags'));
    }
}
