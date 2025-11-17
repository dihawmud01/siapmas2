<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\PAC;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PACController extends Controller
{
    public function index(Request $request)
    {
        $query = PAC::with('users')->latest();
        $message = null; // Definisikan $message di awal

        if ($request->has('search')) {
            $search = $request->search;
            $pacs = $query->where('pac', 'like', "%$search%")->get();

            if ($pacs->isEmpty()) {
                $message = "Data tidak ditemukan untuk: $search";
            }
        } else {
            $pacs = $query->get(); // Ambil semua data tanpa pagination
        }

        return view('admins.pac.index', compact('pacs', 'message'))->with('search', request('search'));
    }


    public function create()
    {
        return view('admins.pac.create');
    }

    public function store(Request $request)
    {
        $pac = $request->all();
        $pac = PAC::create($pac);

        Alert::success('Mantap Sahabat', 'PAC/Komisariat Berhasil Ditambahkan');
        return redirect()->route('pac.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $slug)
    {
        $pac = PAC::with([
            'users' => function ($query) {
                $query->whereIn('role_id', [1, 2, 3]);
            },
        ])
            ->where('slug', $slug)
            ->paginate(25);

        if ($request->has('search')) {
            $user = User::where('username', 'LIKE', '%' . $request->search . '%')
                //   ->orwhere('pac', 'LIKE', '%'.$request->search.'%')
                ->orwhere('name', 'LIKE', '%' . $request->search . '%')
                ->orwhere('nim', 'LIKE', '%' . $request->search . '%')
                ->paginate(25);
        } else {
            $user = User::with('pac')
                ->latest()
                ->paginate(25);
        }

        return view('admins.pac.show', compact('pac', 'user'));
    }

    public function edit($id)
    {
        $pac = PAC::findOrFail($id);

        return view('admins.pac.edit', compact('pac'));
    }

    public function update($id, Request $request)
    {
        $pac = PAC::find($id);
        $pac->pac = $request->pac;
        $pac->update();

        Alert::success('Mantap Sahabat', 'PAC/Komisariat Berhasil Diubah');

        return redirect()->route('pac.index');
    }

    public function destroy($id)
    {
        $pac = PAC::findOrFail($id);
        $pac->delete();

        Alert::success('Mantap Sahabat', 'PAC/Komisariat Berhasil Dihapus');

        return redirect()->route('pac.index');
    }

}