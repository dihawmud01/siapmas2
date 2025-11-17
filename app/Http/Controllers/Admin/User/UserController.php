<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreNewsRequest;
use App\Http\Requests\UpdateNewsRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class UserController extends Controller
{
    /**
     * Display list of users
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $users = User::paginate(5);

        return view('admins.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new users.
     *
     * @return Application|Factory|View
     */
    public function createe()
    {
        $hobbies = [
            'Bermain Game' => 'Bermain Game Online',
            'Bermusik' => 'Bermusik',
            'Olahraga' => 'Berolahraga',
            'Travelling' => 'Travelling',
            'Membaca' => 'Membaca',
            'Seni dan kreativitas' => 'Seni dan kreativitas',
            'Menonton film dan serial TV' => 'Menonton Film/Serial TV',
        ];

        $pacList = [
            'baturraden' => 'BATURRADEN',
            'cilongok' => 'CILONGOK',
            'kedungbanteng' => 'KEDUNGBANTENG',
            'karanglewas' => 'KARANGLEWAS',
            'purwojati' => 'PURWOJATI',
            'purwokerto barat' => 'PURWOKERTO BARAT',
            'purwokerto timur' => 'PURWOKERTO TIMUR',
            'purwokerto utara' => 'PURWOKERTO UTARA',
            'purwokerto selatan' => 'PURWOKERTO SELATAN',
            'sumbang' => 'SUMBANG',
            'sokaraja' => 'SOKARAJA',
            'kembaran' => 'KEMBARAN',
            'tambak' => 'TAMBAK',
            'somagede' => 'SOMAGEDE',
            'banyumas' => 'BANYUMAS',
            'kemranjen' => 'KEMRANJEN',
            'gumelar' => 'GUMELAR',
            'ajibarang' => 'AJIBARANG',
            'pekuncen' => 'PEKUNCEN',
            'wangon' => 'WANGON',
            'rawalo' => 'RAWALO',
            'jatilawang' => 'JATILAWANG',
            'kebasen' => 'KEBASEN',
            'patikraja' => 'PATIKRAJA',
            'kalibagor' => 'KALIBAGOR',
            'lumbir' => 'LUMBIR',
            'sumpiuh' => 'SUMPIUH',
            'unu' => 'KOMISARIAT UNU PURWOKERTO',
            'uin-saizu' => 'KOMISARIAT UIN SAIZU PURWOKERTO',
        ];

        $years = [
            'Belum' => 'Belum',
            '2016' => 'Sebelum 2017',
            '2017' => '2017',
            '2018' => '2018',
            '2019' => '2019',
            '2020' => '2020',
            '2021' => '2021',
            '2022' => '2022',
            '2023' => '2023',
            '2024' => '2024',
            '2025' => '2025',
            '2026' => '2026',
        ];

        $attendanceCount = [
            '0' => 'Belum Pernah',
            '1' => 'Pernah Sekali',
            '2' => 'Pernah 2 Kali',
            '3' => 'Pernah 3 Kali',
            '4' => 'Pernah 4 Kali',
            '5' => 'Pernah 5 Kali',
            '6' => 'Pernah 6 Kali',
            '7' => 'Pernah 7 Kali',
            '8' => 'Pernah 8 Kali',
            '9' => 'Pernah 9 Kali',
            '10' => 'Pernah 10 Kali',
            '11' => 'Lebih dari 10 Kali',
        ];
        return view('admins.users.create', compact('hobbies', 'pacList', 'years', 'attendanceCount'));
    }

    /**
     * Store a newly created users in storage.
     *
     * @param StoreNewsRequest $request
     * @return RedirectResponse|Redirector|Application
     */
    public function store(StoreNewsRequest $request): Application|RedirectResponse|Redirector
    {
        User::create($request->all());

        return redirect()
            ->route('users.index')
            ->with('success', 'User created successfully.');
    }

    /**
     * Show the form for editing the users.
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function edit(int $id)
    {
        $user = User::findOrFail($id);

        return view('admins.users.edit', compact('user'));
    }

    /**
     * Update users.
     *
     * @param UpdateNewsRequest $request
     * @param int $id
     * @return RedirectResponse
     */
public function update(UpdateNewsRequest $request, int $id): RedirectResponse
{
    $user = User::findOrFail($id);

    // Mengecek jika password baru diinputkan
    if ($request->filled('password')) {
        $request->merge(['password' => bcrypt($request->password)]);
    }

    // Update data pengguna termasuk password jika diubah
    $user->update($request->all());

    // Login pengguna dengan data terbaru setelah update
    Auth::login($user);

    return redirect()
        ->route('users.index')
        ->with('success', 'User updated successfully.');
}


    /**
     * Delete User.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $user = User::findOrFail($id);

        if ($user->posts()->count()) {
            return redirect()
                ->route('users.index')
                ->with('error', 'Error! The users has entries.');
        }

        $user->delete();

        return redirect()
            ->back()
            ->with('info', 'User deleted successfully!');
    }
}
