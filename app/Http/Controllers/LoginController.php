<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

/**
 * Summary of LoginController
 */
class LoginController extends Controller
{
    public function login()
    {
        if (auth()->check()) {
            return redirect('/');
        }

        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $user = User::where('email', $credentials['email'])->first();

        if (Auth::attempt($credentials) && $user) {
            Alert::success('Mantap Rekan/Rekanita', 'Anda Berhasil Masuk');

            return redirect()->intended(route('index'));
        } else {
            return redirect()
                ->back()
                ->with('error', 'Email atau Password Salah');
        }
    }

    public function showValidation()
    {
        return view('auth.validation');
    }

    public function validateUser(Request $request)
    {
        $nim = $request->input('nim');
        $user = User::where('nim', $nim)->first();

        if ($user) {
            if ($user->email) {
                Alert::info('Email Sudah Terdaftar', 'Anda Sudah Memiliki Akun, Tinggal Login Saja');
                return redirect()->route('login');
            } else {
                return redirect()->route('register', ['users' => $user]);
            }
        } else {
            Alert::error(
                'Maaf Sahabat',
                'Email Anda belum terdaftar.
        Mohon minta admins PAC untuk melakukan
        sensus terlebih dahulu, lalu registrasi kembali.',
            );

            return redirect()->route('login');
        }
    }

    public function register($user, Request $request)
    {
        $user = User::find($user);

        $pacList = [
            'BATURRADEN',
            'CILONGOK',
            'KEDUNGBANTENG',
            'KARANGLEWAS',
            'PURWOJATI',
            'PURWOKERTO BARAT',
            'PURWOKERTO TIMUR',
            'PURWOKERTO UTARA',
            'PURWOKERTO SELATAN',
            'SUMBANG',
            'SOKARAJA',
            'KEMBARAN',
            'TAMBAK',
            'SOMAGEDE',
            'BANYUMAS',
            'KEMRANJEN',
            'GUMELAR',
            'AJIBARANG',
            'PEKUNCEN',
            'WANGON',
            'RAWALO',
            'JATILAWANG',
            'KEBASEN',
            'PATIKRAJA',
            'KALIBAGOR',
            'LUMBIR',
            'SUMPIUH',
            'KOMISARIAT UNU PURWOKERTO',
            'KOMISARIAT UIN SAIZU PURWOKERTO',
        ];

        return view('auth.register', compact('user', 'pacList'));
    }

    public function store($id, Request $request)
    {
        $rules = [
            'username' => 'required|unique:users,username',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
        ];

        $messages = [
            'username.required' => 'Username wajib diisi.',
            'username.unique' => 'Username sudah digunakan.',
            'email.required' => 'Email wajib diisi.',
            'email.unique' => 'Email sudah digunakan.',
            'nim.required' => 'NIM wajib diisi.',
            'nim.unique' => 'NIM sudah digunakan.',
            'nim.min' => 'NIM harus memiliki minimal 14 angka.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.regex' => 'Password harus terdiri dari huruf kapital, huruf kecil, dan angka.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::find($id);
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        Alert::success('Mantap Rekaj', 'Anda Berhasil Register');

        return redirect()->route('login');
    }

    /**
     * Summary of logout
     * @param Request $request
     * @return RedirectResponse
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
