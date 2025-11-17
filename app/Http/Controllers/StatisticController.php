<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Letter;
use App\Models\News;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class StatisticController extends Controller
{
    public function index(Request $request)
    {
        $userCounts = Member::count();

        // User counts by role id
        $roleIds = range(1, 4);

        $members = User::selectRaw('role_id, COUNT(*) as count')
            ->whereIn('role_id', $roleIds)
            ->groupBy('role_id')
            ->pluck('count', 'role_id');

        $memberCounts = [];
        $cadreCounts = 0;

        foreach ($roleIds as $roleId) {
            if (in_array($roleId, range(1, 3))) {
                $memberCounts[$roleId] = $members->get($roleId, 0);
            } else {
                $cadreCounts = $members->get($roleId, 0);
                $cadreCounts = min($cadreCounts, 10);
            }
        }

        // Member counts by cadres level
        $formalMemberLevels = Member::selectRaw(
            "
        SUM(CASE WHEN is_makesta = 1 THEN 1 ELSE 0 END) AS makesta,
        SUM(CASE WHEN is_lakmud = 1 THEN 1 ELSE 0 END) AS lakmud,
        SUM(CASE WHEN is_lakut = 1 THEN 1 ELSE 0 END) AS lakut
        ",
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
        ",
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

        $news = News::with('category', 'tags')
            ->where('active', 1)
            ->take(10)
            ->get()
            ->map(function ($post) {
                $post->formatted_updated_date = Carbon::parse($post->updated_at)->format('Y-m-d');

                return $post;
            });

        $todayIncomingLetter = Letter::incoming()
            ->today()
            ->count();
        $todayOutgoingLetter = Letter::outgoing()
            ->today()
            ->count();
        $todayLetterTransaction = $todayIncomingLetter + $todayOutgoingLetter;

        $yesterdayIncomingLetter = Letter::incoming()
            ->yesterday()
            ->count();
        $yesterdayOutgoingLetter = Letter::outgoing()
            ->yesterday()
            ->count();
        $yesterdayLetterTransaction = $yesterdayIncomingLetter + $yesterdayOutgoingLetter;

        return view(
            'admins.index',
            compact(
                'news',
                'memberCounts',
                'cadreCounts',
                'userCounts',
                'formalMemberLevelCounts',
                'genderCounts',
                'pacCounts',
                'makestaCounts',
                'lakmudCounts',
                'lakutCounts',
                'todayIncomingLetter',
                'todayOutgoingLetter',
                'todayLetterTransaction',
            ),
        );
    }
}