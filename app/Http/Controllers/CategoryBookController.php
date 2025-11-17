<?php

namespace App\Http\Controllers;

use App\Models\BookCategory;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CategoryBookController extends Controller
{
    public function index(Request $request)
    {
        $bookCategory = BookCategory::with('libraries')->get();
        return view('admins.book-categories.index', compact('bookCategory'));
    }

    public function create()
    {
        return view('admins.book-categories.create');
    }

    public function store(Request $request)
    {
        $categoryData = $request->only('title', 'slug');
        $category = BookCategory::create($categoryData);

        Alert::success('Mantap Sahabat', 'Category Buku Berhasil Ditambahkan');

        return redirect()->route('book-categories.index');
    }

    public function show($id, Request $request)
    {
        $bookCategory = BookCategory::with('libraries')
            ->paginate(10)
            ->find($id);
        return view('admins.book-categories.show', compact('bookCategory'));
    }

    public function edit($id, Request $request)
    {
        $bookCategory = BookCategory::find($id);
        return view('admins.book-categories.edit', compact('bookCategory'));
    }

    public function update($id, Request $request)
    {
        $bookCategory = BookCategory::findOrFail($id);
        $bookCategory->update($request->all());

        Alert::success('Mantap Sahabat', 'Category Buku Berhasil Di Ubah');

        return redirect()->route('book-categories.index');
    }

    public function destroy($id)
    {
        $bookCategory = BookCategory::findOrFail($id);
        if ($bookCategory->perpus()->count()) {
            Alert::error('Error Sahabat', 'Category Buku Sedang Terisi / Tidak Kosong');

            return redirect()
                ->route('book-categories.index')
                ->with('error', 'Error! The categories has entries.');
        }

        $bookCategory->delete();

        Alert::success('Mantap Sahabat', 'Category Buku Berhasil Dihapus');

        return redirect()->route('book-categories.index');
    }
}
