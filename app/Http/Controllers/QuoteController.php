<?php

namespace App\Http\Controllers;

use App\Models\Quote;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class QuoteController extends Controller
{
    public function index(Request $request)
    {
        $quotes = Quote::latest()->get();
        return view('admins.quotes.index', compact('quotes'));
    }

    public function createQuote()
    {
        return view('admins.quotes.create');
    }

    public function storeQuote(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $quotes = $request->all();

    if ($request->hasFile('img')) {
        $file = $request->file('img');
        $newFileName = 'quotes_' . $request->name . '_' . now()->timestamp . '.' . $file->getClientOriginalExtension();

        // Simpan ke storage/app/public/images
        $file->storeAs('images', $newFileName, 'public');

        // Simpan nama file ke kolom img
        $quotes['img'] = $newFileName;
    }
        $quotes = Quote::create($quotes);
        Alert::success('Mantap Sahabat', 'Quote Berhasil Ditambahkan');

        return redirect()->route('quotes.index');
    }
    public function editQuote($id, Request $request)
    {
        $quote = Quote::find($id);

        return view('admins.quotes.edit', compact('quote'));
    }
    public function updateQuote($id, Request $request)
    {
        $quoteToUpdate = Quote::findOrFail($id);

        $quoteData = $request->all();
        if ($request->img) {
            $extension = $request->img->getClientOriginalExtension();
            $newFileName = 'quotes_update' . '_' . $request->name . '-' . now()->timestamp . '.' . $extension;
            if ($request->hasFile('img')) {
                $file = $request->file('img');
                $newFileName = 'gambar_' . now()->timestamp . '.' . $file->getClientOriginalExtension();
                $file->move(storage_path('app/public/images'), $newFileName);
                $data['img'] = $newFileName; // jika kamu simpan ke database
            } else {
                // Optional: handle jika tidak ada file
                // Misalnya log atau kasih nilai default
            }

            $quoteData['img'] = $newFileName;
        }

        $quoteToUpdate->update($quoteData);

        Alert::success('Mantap Sahabat', 'Quote Berhasil Di Ubah');

        return redirect()->route('quotes.index');
    }
    public function destroyQuote($id)
    {
        $quotes = Quote::findOrFail($id);
        $quotes->delete();

        Alert::success('Mantap Sahabat', 'Quote Berhasil Dihapus');

        return redirect()->route('quotes.index');
    }
}
