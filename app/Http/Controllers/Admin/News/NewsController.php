<?php

namespace App\Http\Controllers\Admin\News;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreNewsRequest;
use App\Http\Requests\UpdateNewsRequest;
use App\Models\Category;
use App\Models\News;
use App\Models\Tag;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $news = News::with('category', 'tags')->paginate(10);

        return view('admins.news.index', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $categories = Category::pluck('title', 'id')->all();
        $tags = Tag::pluck('title', 'id')->all();

        return view('admins.news.create', compact('categories', 'tags'));
    }

   public function store(Request $request): RedirectResponse
{
    // Tambahkan validasi di sini
    $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'required',
        'category_id' => 'required|exists:categories,id',
        'img' => 'required|image|mimes:jpg,jpeg,png|max:2048',
    ], [
        'img.required' => 'Silakan upload gambar terlebih dahulu.',
        'img.image' => 'File harus berupa gambar.',
        'img.mimes' => 'Format gambar harus jpg, jpeg, atau png.',
        'img.max' => 'Ukuran gambar maksimal 2MB.',
    ]);

    $data = $request->all();
    $data['user_id'] = Auth::user()->id;

    if ($request->img) {
        $extension = $request->img->getClientOriginalExtension();
        $newFileName = $request->title . '_' . 'PC_IPNU_IPPNU_BANYUMAS' . '-' . now()->timestamp . '.' . $extension;
        $request->file('img')->move(public_path('/storage/images'), $newFileName);
        $data['img'] = $newFileName;
    }

    $news = News::create($data);
    $news->tags()->sync($request->tags);

    return redirect()
        ->route('news.index')
        ->with('success', 'News created successfully!');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function edit(int $id)
    {
        $news = News::findOrFail($id);
        $categories = Category::pluck('title', 'id')->all();
        $tags = Tag::pluck('title', 'id')->all();

        // dd($news);
        return view('admins.news.edit', compact('categories', 'tags', 'news'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(Request $request, int $id): RedirectResponse
    {
        $news = News::findOrFail($id);
        $data = $request->all();

        if ($request->img) {
            $extension = $request->img->getClientOriginalExtension();
            $newFileName = 'news' . '_' . $request->nama . '-' . now()->timestamp . '.' . $extension;
            $request->file('img')->move(public_path('/storage/images'), $newFileName);
            $data['img'] = $newFileName;
        }

        $news->update($data);
        $news->tags()->sync($request->tags);

        return redirect()
            ->route('news.index')
            ->with('success', 'News updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $news = News::findOrFail($id);
        $news->tags()->sync([]);

        if ($news->img) {
            $image_path = public_path() . $news->img;
            if (File::exists($image_path)) {
                File::delete($image_path);
            }
        }

        $news->delete();

        return redirect()
            ->route('news.index')
            ->with('success', 'News deleted successfully!');
    }
}
