<?php

namespace App\Http\Controllers;

use App\Models\HBN;
use App\Models\Agenda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;

class AgendaController extends Controller
{
    public function index()
    {
        Carbon::setLocale('id');

        $user = Auth::user();

        $hbn = HBN::latest()
            ->take(20)
            ->get()
            ->map(function ($day) {
                $day->formatted_date = Carbon::parse($day->date)->translatedFormat('l, d F Y');

                return $day;
            });

        $events = Agenda::latest()
            ->get()
            ->map(function ($event) {
                $event->formatted_date = Carbon::parse($event->date)->translatedFormat('l, d F Y');
                $event->time = Carbon::parse($event->date)->translatedFormat('H:i');

                return $event;
            });

        return view('users.calendar', compact('events', 'user', 'hbn', 'events'));
    }

    public function adminIndex()
    {
        $events = Agenda::all();

        return view('admins.calendar.index', compact('events'));
    }

    public function create()
    {
        $organizers = [
            'PC IPNU IPPNU BANYUMAS',
            'PAC BATURRADEN',
            'PAC CILONGOK',
            'PAC KEDUNGBANTENG',
            'PAC KARANGLEWAS',
            'PAC PURWOJATI',
            'PAC PURWOKERTO BARAT',
            'PAC PURWOKERTO TIMUR',
            'PAC PURWOKERTO UTARA',
            'PAC PURWOKERTO SELATAN',
            'PAC SUMBANG',
            'PAC SOKARAJA',
            'PAC KEMBARAN',
            'PAC TAMBAK',
            'PAC SOMAGEDE',
            'PAC BANYUMAS',
            'PAC KEMRANJEN',
            'PAC GUMELAR',
            'PAC AJIBARANG',
            'PAC PEKUNCEN',
            'PAC WANGON',
            'PAC RAWALO',
            'PAC JATILAWANG',
            'PAC KEBASEN',
            'PAC PATIKRAJA',
            'PAC KALIBAGOR',
            'PAC LUMBIR',
            'PAC SUMPIUH',
            'KOMISARIAT UNU PURWOKERTO',
            'KOMISARIAT UIN SAIZU PURWOKERTO',
        ];

        $categories = ['Formal', 'Informal'];

        return view('admins.calendar.create', compact('organizers', 'categories'));
    }

    public function store(Request $request)
    {
        $events = $request->all();

        if ($request->pamphlet) {
            $extension = $request->pamphlet->getClientOriginalExtension();
            $newFileName = 'agenda' . '_' . $request->organizer . '-' . now()->timestamp . '.' . $extension;
            $request->file('pamphlet')->move(public_path('/storage/images'), $newFileName);
            $events['pamphlet'] = $newFileName;
        }

        Agenda::create($events);

        Alert::success('Mantap Rekan', 'Agenda Berhasil Ditambahkan');

        return redirect()->route('admin.calendar.index');
    }

    public function edit($id, Request $request)
    {
        // Cari data event berdasarkan ID
        $event = Agenda::find($id);

        // Jika tidak ditemukan, redirect dengan pesan error
        if (!$event) {
            return redirect()->route('admin.calendar.index')
                            ->with('error', 'Agenda tidak ditemukan');
        }

        // Format 'date' untuk ditampilkan dalam input 'datetime-local'
        $event->formatted_date = Carbon::parse($event->date)->format('Y-m-d\TH:i');

        // Daftar organizer yang dapat dipilih
        $organizers = [
            'PC IPNU IPPNU BANYUMAS',
            'PAC BATURRADEN',
            'PAC CILONGOK',
            'PAC KEDUNGBANTENG',
            'PAC KARANGLEWAS',
            'PAC PURWOJATI',
            'PAC PURWOKERTO BARAT',
            'PAC PURWOKERTO TIMUR',
            'PAC PURWOKERTO UTARA',
            'PAC PURWOKERTO SELATAN',
            'PAC SUMBANG',
            'PAC SOKARAJA',
            'PAC KEMBARAN',
            'PAC TAMBAK',
            'PAC SOMAGEDE',
            'PAC BANYUMAS',
            'PAC KEMRANJEN',
            'PAC GUMELAR',
            'PAC AJIBARANG',
            'PAC PEKUNCEN',
            'PAC WANGON',
            'PAC RAWALO',
            'PAC JATILAWANG',
            'PAC KEBASEN',
            'PAC PATIKRAJA',
            'PAC KALIBAGOR',
            'PAC LUMBIR',
            'PAC SUMPIUH',
            'KOMISARIAT UNU PURWOKERTO',
            'KOMISARIAT UIN SAIZU PURWOKERTO',
        ];

        // Daftar kategori yang bisa dipilih
        $categories = ['Formal', 'Informal'];

        // Kirim data ke view
        return view('admins.calendar.edit', compact('event', 'organizers', 'categories'));
    }




    public function update($id, Request $request)
    {
        $eventToUpdate = Agenda::findOrFail($id);
        $event = $request->except('pamphlet'); // Ambil semua kecuali pamflet

        // Cek jika ada file pamflet baru
        if ($request->hasFile('pamphlet')) {
            $extension = $request->pamphlet->getClientOriginalExtension();
            $newFileName = 'agenda_' . $request->organizer . '-' . now()->timestamp . '.' . $extension;
            $request->file('pamphlet')->move(public_path('/storage/images'), $newFileName);
            $event['pamphlet'] = $newFileName;
        }

        // Handle status checkbox
        $event['status'] = $request->has('status') ? true : false;

        $eventToUpdate->update($event);

        Alert::success('Mantap Rekan', 'Agenda Berhasil Di Ubah');
        return redirect()->route('admin.calendar.index');
    }


    public function destroy($id)
{
    $event = Agenda::find($id);

    if (!$event) {
        return redirect()->route('admin.calendar.index')
                         ->with('error', 'Agenda tidak ditemukan');
    }

    // Hapus file pamflet jika ada
    if ($event->pamphlet && file_exists(public_path('/storage/images/' . $event->pamphlet))) {
        unlink(public_path('/storage/images/' . $event->pamphlet));
    }

    $event->delete();

    Alert::success('Mantap Rekan', 'Agenda Berhasil Dihapus');

    return redirect()->route('admin.calendar.index');
}

    public function getEvents()
    {
        $events = Agenda::all()->map(function ($agenda) {
            return [
                'title' => $agenda->title,
                'start' => $agenda->date, // Gunakan format asli jika butuh waktu
                'allDay' => false, // False agar mendukung waktu HH:MM:SS
                'color' => $this->getCategoryColor($agenda->category),
            ];
        });

        return response()->json($events);
    }


    private function getCategoryColor($category)
    {
        $colors = [
            'Seminar' => '#007bff',  // Biru
            'Workshop' => '#28a745', // Hijau
            'Kompetisi' => '#ffc107', // Kuning
            'Lainnya' => '#dc3545',  // Merah
        ];

        return $colors[$category] ?? '#6c757d'; // Default abu-abu jika tidak ada kategori
    }
    public function getFull(){
        return view('users.calendar_full');
    }
}
