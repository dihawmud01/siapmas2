<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Member;
use App\Models\Tag;
use App\Models\News;
use App\Models\User;
use App\Models\Library;
use App\Models\Category;
use App\Models\BookCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Laravolt\Indonesia\Models\City;
use Laravolt\Indonesia\Models\District;
use Laravolt\Indonesia\Models\Province;
use Laravolt\Indonesia\Models\Village;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */

    public function index()
    {
        $profile = Auth::user();

        $news = News::where('user_id', '=', $profile->id)
            ->with('category', 'comments', 'user')
            ->where('active', 1)
            ->latest()
            ->get();

        // Count the number of picture and book news uploaded by users
        $postCounts = News::where('user_id', '=', $profile->id)
            ->where('active', 1)
            ->count();

        $categories = Category::pluck('title', 'id')->all();
        $tags = Tag::pluck('title', 'id')->all();
        $user = Auth::user();

        return view('users.profile', compact('tags', 'user', 'profile', 'postCounts', 'categories', 'news'));
    }

    public function showAccount()
    {
        $categories = Category::pluck('title', 'id')->all();
        $tags = Tag::pluck('title', 'id')->all();
        $user = Auth::user();

        $genders = [
            'male' => 'Laki-laki',
            'female' => 'Perempuan',
        ];

        return view('users.account', compact('user', 'categories', 'tags', 'genders'));
    }

    public function update(ProfileUpdateRequest $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'bio' => 'required|string|max:255',
    ]);

    $user = Auth::user();
    $user->fill(
        $request->only([
            'phone',
            'x',
            'fb',
            'ig',
            'bio',
        ]),
    );
    // Handle profile image update
    if ($request->input('remove_img') == '1') {
        $user->photo = 'default.png';
    
    } elseif ($request->hasFile('images')) {
        $file = $request->file('images');
        $extension = $file->getClientOriginalExtension();
        $newFileName = 'profile_' . $user->username . '-' . now()->timestamp . '.' . $extension;
        // Buat folder user jika belum ada
        $destinationPath = storage_path('app/public/images/user/photos/' . $user->id);
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }

        // Simpan file ke folder yang sesuai
        $file->move($destinationPath, $newFileName);
    
        // Simpan nama file ke kolom 'photo'
        $user->photo = $newFileName;
    }

// Save user details
$user->save();

Alert::success('Mantap Rekan/Rekanita', 'Profil Anda Sudah Diperbaharui');

return redirect()
    ->route('profile')
    ->with('users', $user);
}

    
    public function store(Request $request): RedirectResponse
{
    // Validate incoming request
    $request->validate([
        'name' => 'required|string|max:255',
        'bio' => 'required|string|max:255',
    ]);

    $data = $request->all();
    $data['user_id'] = Auth::user()->id;  // Assign logged-in user as the owner

    // Handle file upload for profile image
    if ($request->hasFile('images')) {
        $file = $request->file('images');
        $extension = $file->getClientOriginalExtension();
        $newFileName = 'profile_' . Auth::user()->username . '-' . now()->timestamp . '.' . $extension;
        $file->storeAs('images', $newFileName, 'public');
        $data['images'] = $newFileName;
    }

    // Create a new user entry with the provided data
    $user = User::create($data);

    Alert::success('Mantap Rekan/Rekanita', 'Profil Baru Anda Berhasil Disimpan');

    return redirect()
        ->route('profile')
        ->with('users', $user);
}


    public function showUploads(Request $request)
    {
        $categories = Category::pluck('title', 'id')->all();
        $tags = Tag::pluck('title', 'id')->all();
        $user = Auth::user();

        $postCounts = News::where('user_id', $user->id)
            ->where('active', 1)
            ->count();

        $category = BookCategory::all();

        return view('users.uploads', compact('user', 'tags', 'category', 'postCounts', 'categories'));
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
            'reenter_password' => 'required|same:new_password',
        ]);

        $user = Auth::user();

        if (! Hash::check($request->input('current_password'), $user->password)) {
            return redirect()
                ->back()
                ->withErrors([
                    'current_password' => 'Kata sandi yang diberikan tidak cocok dengan kata sandi Anda saat ini.',
                ]);
        }

        $user->password = Hash::make($request->input('new_password'));
        $user->save();

        return redirect()
            ->back()
            ->with('Mantap Rekan/Rekanita', 'Password Berhasil Diubah.');
    }

    public function storePost(Request $request): RedirectResponse
    {
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;

        if ($request->img) {
            $extension = $request->img->getClientOriginalExtension();
            $newFileName = 'news' . '_' . $request->name . '-' . now()->timestamp . '.' . $extension;
            $request->file('image')->move(public_path('/storage/images'), $newFileName);
            $data['image'] = $newFileName;
        }

        $post = News::create($data);
        $post->tags()->sync($request->tags);

        Alert::success('Mantap Sahabat', 'Postingan akan ditinjau terlebih dahulu oleh admins');

        return redirect()->route('profile');
    }

    public function storeLibrary(Request $request)
    {
        $library = $request->all();
        $library['user_id'] = Auth::user()->id;

        if ($request->img) {
            $extension = $request->img->getClientOriginalExtension();
            $newFileName = 'libraries' . '_' . $request->name . '-' . now()->timestamp . '.' . $extension;
            $request->file('image')->move(public_path('/storage/images'), $newFileName);
            $library['image'] = $newFileName;
        }

        if ($request->pdf) {
            $extension = $request->pdf->getClientOriginalExtension();
            $newFileName = 'libraries' . '_' . $request->name . '-' . now()->timestamp . '.' . $extension;
            $request->file('pdf')->move(public_path('/storage/pdf'), $newFileName);
            $library['pdf'] = $newFileName;
        }

        Library::create($library);

        Alert::success('Mantap Sahabat', 'File Berhasil Ditambahkan');

        return redirect()->route('profile');
    }

    //    public function showDetail($id, Request $request)
    //    {
    //        $member = Member::findOrFail($id);
    //
    //        //        $detailUser = [
    //        //            'Nama Lengkap' => $member->name,
    //        //            'NIM' => $member->nim,
    //        //            'Alamat' =>
    //        //                ($provinsi->name ?? '') .
    //        //                ', ' .
    //        //                ($city->name ?? '') .
    //        //                ', ' .
    //        //                ($district->name ?? '') .
    //        //                ', ' .
    //        //                ($village->name ?? '') .
    //        //                ',' .
    //        //                ($member->address ?? ''),
    //        //            'Pesantren' => $member->boarding_school,
    //        //            'Tempat, Tanggal Lahir' => $member->place_of_birth . ', ' . $member->date_of_birth,
    //        //            'SMA/SMK/MA/Sederajat' => $member->highschool,
    //        //            'Tahun Lulus' => $member->grad_year,
    //        //            'Tahun Kuliah' => $member->bachelor_year,
    //        //            'PAC' => $member->pac->pac,
    //        //            'Tahun Makesta' => $member->makesta_year,
    //        //            'Tahun Lakmud' => $member->lakmud_year,
    //        //            'Tahun Lakut' => $member->lakut,
    //        //            'Tahun Latinpel' => $member->latinpel,
    //        //        ];
    //
    //        return view('admins.members.detail', compact('member'));
    //    }

    public function show($slug, Request $request)
    {
        $user = Auth::user();
        $profile = User::where('slug', $slug)->firstOrFail();

        $news = News::where('user_id', '=', $profile->id)
            ->with('category', 'comments', 'user')
            ->where('active', 1)
            ->latest()
            ->get();

        //        $libraryProfiles = Library::where('user_id', $profile->id)->get();

        $postCounts = News::where('user_id', '=', $profile->id)
            ->where('active', 1)
            ->count();

        //        $libraryCounts = Library::where('user_id', '=', $profile->id)->count();

        return view('users.user-profile', compact('user', 'profile', 'postCounts', 'news'));
    }
}
