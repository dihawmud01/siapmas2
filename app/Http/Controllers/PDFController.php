<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\PAC;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class PDFController extends Controller
{
    public function pacPDF($slug, Request $request)
    {
        $category = $request->query('category', 'all'); // Default 'all' jika tidak ada pilihan

        $pac = PAC::where('slug', $slug)
            ->with(['members' => function ($query) use ($category) {
                if ($category === 'IPNU') {
                    $query->where('gender', 'male'); // IPNU → laki-laki
                } elseif ($category === 'IPPNU') {
                    $query->where('gender', 'female'); // IPPNU → perempuan
                }
                // Jika kategori "all", tidak perlu filter tambahan (semua data masuk)
            }])
            ->latest()
            ->first();

        if (!$pac) {
            abort(404);
        }

        $count_user = $pac->members->count();
        $now = Carbon::now()->format('d-m-Y');

        return view('admins.pac.pac-pdf', compact('pac', 'now', 'category'))
            ->with('userCounts', $count_user);
    }

    public function cadrePDF($id, Request $request)
    {
        $users = User::findOrFail($id);
        $now = Carbon::now()->format('Y-m-d');

        return view('admins.members.pdf', compact('users', 'now'));
    }
}