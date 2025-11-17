<?php

namespace App\Http\Controllers;

use App\Models\Home;
use App\Models\News;
use App\Models\Member;
use App\Models\Quote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $home = Home::all();

        $quotes = Quote::latest()
            ->take(5)
            ->get();

        $recentNews = News::with('category', 'user')
            ->where('active', '1')
            ->latest()
            ->paginate(15);

        // Member counts by cadres level
        $formalMemberLevels = Member::selectRaw(
            "
        SUM(CASE WHEN is_makesta = 1 THEN 1 ELSE 0 END) AS makesta,
        SUM(CASE WHEN is_lakmud = 1 THEN 1 ELSE 0 END) AS lakmud,
        SUM(CASE WHEN is_lakut = 1 THEN 1 ELSE 0 END) AS lakut
        "
        )->first();

        $formalMemberLevelCounts = [
            'makesta' => $formalMemberLevels->makesta,
            'lakmud' => $formalMemberLevels->lakmud,
            'lakut' => $formalMemberLevels->lakut,
        ];

        // Member counts by gender
        $genderCounts = Member::selectRaw(
            "
        gender, COUNT(*) AS count
        "
        )
            ->groupBy('gender')
            ->pluck('count', 'gender')
            ->toArray();

        // Member counts by PAC
        $pacCounts = Member::selectRaw('pac_id, COUNT(*) as count')
            ->groupBy('pac_id')
            ->pluck('count', 'pac_id')
            ->toArray();

        // Member counts by formal cadre level year
        $makestaCounts = Member::selectRaw('makesta_year, COUNT(*) as count')
            ->whereNotNull('makesta_year')
            ->groupBy('makesta_year')
            ->pluck('count', 'makesta_year')
            ->toArray();

        $lakmudCounts = Member::selectRaw('lakmud_year, COUNT(*) as count')
            ->whereNotNull('lakmud_year')
            ->groupBy('lakmud_year')
            ->pluck('count', 'lakmud_year')
            ->toArray();

        $lakutCounts = Member::selectRaw('lakut_year, COUNT(*) as count')
            ->whereNotNull('lakut_year')
            ->groupBy('lakut_year')
            ->pluck('count', 'lakut_year')
            ->toArray();

        return view(
            'users.home',
            compact([
                'home',
                'user',
                'quotes',
                'recentNews',
                'formalMemberLevelCounts',
                'genderCounts',
                'pacCounts',
                'makestaCounts',
                'lakmudCounts',
                'lakutCounts',
            ])
        );
    }

    public function adminIndex()
    {
        $pages = Home::all();

        return view('admins.pages.index', compact(['pages']));
    }

    public function edit($id)
    {
        $pages = Home::find($id);
        return view('admins.pages.edit', compact(['pages']));
    }

    public function update($id, Request $request)
    {
        $pagesToUpdate = Home::findOrFail($id);
        // dd($request->img);

        $pagesData = $request->all();
        if ($request->img) {
            $extension = $request->img->getClientOriginalExtension();
            $newFileName = 'banner_update' . '_' . $request->name . '-' . now()->timestamp . '.' . $extension;
            $request->file('img')->move(public_path('/storage/images'), $newFileName);
            $pagesData['img'] = $newFileName;
        }

        $pagesToUpdate->update($pagesData);

        Alert::success('Mantap Rekan', 'Banner Berhasil Di Ubah');
        return redirect()->route('pages.index');
    }
}
