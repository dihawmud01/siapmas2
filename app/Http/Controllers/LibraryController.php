<?php

namespace App\Http\Controllers;

use App\Models\Library;
use App\Models\BookCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Http\RedirectResponse;
use RealRashid\SweetAlert\Facades\Alert;

class LibraryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $library = Library::with('book_categories')
                ->where('title', 'LIKE', '%' . $request->search . '%')
                ->orwhere('penulis', 'LIKE', '%' . $request->search . '%')
                ->get();
        } else {
            $library = Library::with('book_categories')
                ->latest()
                ->paginate(25);
        }

        $user = Auth::user();

        return view('users.libraries', compact('user', 'library'));
    }
    public function show($id, Request $request)
    {
        $user = Auth::user();
        $library = Library::find($id);

        return view('users.details', compact('user', 'library'));
    }

    public function adminIndex(Request $request)
    {
        $libraries = Library::with('book_categories')->paginate(10);

        return view('admins.libraries.index', compact('libraries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $category = BookCategory::all();

        return view('admins.libraries.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $library = $request->all();
        $library['user_id'] = Auth::user()->id;

        if ($request->img) {
            $extension = $request->img->getClientOriginalExtension();
            $newFileName = $request->title . '_' . 'PC-IPNU-IPPNU-Banyumas' . '-' . now()->timestamp . '.' . $extension;
            $request->file('img')->move(storage_path('app/public/images'), $newFileName);
            $library['img'] = $newFileName;
        }

        if ($request->pdf) {
            $extension = $request->pdf->getClientOriginalExtension();
            $newFileName = $request->title . '-' . 'PC-IPNU-IPPNU-Banyumas' . now()->timestamp . '.' . $extension;
            $request->file('pdf')->move(storage_path('app/public/pdf'), $newFileName);
            $library['pdf'] = $newFileName;
        }

        Library::create($library);

        Alert::success('Mantap Sahabat', 'File Berhasil Ditambahkan');

        return redirect()->route('admin.libraries.index');
    }

    public function edit($id, Request $request)
    {
        $library = Library::find($id);
        $category = BookCategory::all();
        return view('admins.libraries.edit', compact('library', 'category'));
    }

    public function update($id, Request $request)
    {
        $libraryToUpdate = Library::findOrFail($id);

        $libraryData = $request->all();
        if ($request->img) {
            $extension = $request->img->getClientOriginalExtension();
            $newFileName = 'quotes_update' . '_' . $request->title . '-' . now()->timestamp . '.' . $extension;
            $request->file('images')->move(storage_path('app/public/images'), $newFileName);
            $libraryData['images'] = $newFileName;
        }

        $libraryToUpdate->update($libraryData);

        Alert::success('Mantap Sahabat', 'Buku Berhasil Di Ubah');

        return redirect()->route('admin.libraries.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): RedirectResponse
    {
        $library = Library::findOrFail($id);

        if ($library->img) {
            $imgPath = storage_path('app/public/images/' . $library->img);
            if (File::exists($imgPath)) {
                File::delete($imgPath);
            }
        }

        if ($library->pdf) {
            $pdfPath = storage_path('app/public/pdf/' . $library->pdf);
            if (File::exists($pdfPath)) {
                File::delete($pdfPath);
            }
        }

        $library->delete();

        return redirect()
            ->route('admin.libraries.index')
            ->with('success', 'Buku deleted successfully!');
    }
}
