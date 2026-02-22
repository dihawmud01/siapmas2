<?php

namespace App\Http\Controllers;

use App\Models\Administrator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class AdministratorController extends Controller
{
    public function show(Request $request)
    {
        $user = Auth::user();
        $administrators = Administrator::all();
        return view('users.administrators', compact('user', 'administrators'));
    }

    public function index(Request $request)
    {
        $administrators = Administrator::latest()->get();
        return view('admins.administrators.index', compact('administrators'));
    }

    public function create()
    {
        return view('admins.administrators.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $administrators = $request->all();

        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $newFileName =
                'administrators_' . $request->name . '_' . now()->timestamp . '.' . $file->getClientOriginalExtension();

            // Simpan ke storage/app/public/images
            $file->storeAs('images', $newFileName, 'public');

            // Simpan nama file ke kolom img
            $administrators['img'] = $newFileName;
        }

        Administrator::create($administrators);

        Alert::success('Mantap Sahabat', 'Administrator Berhasil Ditambahkan');

        return redirect()->route('administrators.index');
    }

    public function edit($id, Request $request)
    {
        $administrator = Administrator::find($id);

        return view('admins.administrators.edit', compact('administrator'));
    }

    public function update($id, Request $request)
    {
        $administratorToUpdate = Administrator::findOrFail($id);

        $administratorData = $request->all();
        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $newFileName =
                'administrator_update' .
                '_' .
                $request->name .
                '-' .
                now()->timestamp .
                '.' .
                $file->getClientOriginalExtension();
            $file->move(storage_path('app/public/images'), $newFileName);
            $administratorData['img'] = $newFileName;
        }

        $administratorToUpdate->update($administratorData);

        Alert::success('Mantap Rekan/Rekanita', 'administrators Berhasil Di Ubah');

        return redirect()->route('administrators.index');
    }

    public function destroy($id)
    {
        $administrator = Administrator::findOrFail($id);
        $administrator->delete();

        Alert::success('Mantap Rekan/Rekanita', 'Administrator Berhasil Dihapus');

        return redirect()->route('administrators.index');
    }
}
