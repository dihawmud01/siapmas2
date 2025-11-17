<?php

namespace App\Http\Controllers;

use App\Models\HBN;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class HBNController extends Controller
{
    public function index(Request $request)
    {
    $hbns = HBN::latest()->paginate(20);
    return view ('admins.hbn.index', compact('hbns'));
    }
    public function create()
    {
    return view('admins.hbn.create');
    }
    public function store(Request $request)
    {
      $hbns = $request -> all();
      $hbns = HBN::create($hbns);

      Alert::success('Mantap Rekan/Rekanita', 'Hari Besar Berhasil Ditambahkan');
      return redirect()->route('hbn.index');
    }
    public function destroy($id)
    {
        $quotes = HBN::findOrFail($id);
        $quotes->delete();
        Alert::success('Mantap Rekan/Rekanita', 'Hari Besar Berhasil Dihapus');
        return redirect()->route('hbn.index');
    }
    public function getHbnEvents()
    {
        $events = HBN::all()->map(function ($hbn) {
            return [
                'title' => $hbn->title,
                'start' => date('Y-m-d', strtotime($hbn->date)), // Format tanpa waktu
                'color' => '#dc3545', // Warna merah untuk hari besar nasional
            ];
        });

        return response()->json($events);
  }

}
