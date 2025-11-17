<?php

namespace App\Http\Controllers;
use Laravolt\Indonesia\Models\District;
use Laravolt\Indonesia\Models\Province;
use Laravolt\Indonesia\Models\City;

use Illuminate\Http\Request;

class LaravoltController extends Controller
{
    public function showCity()
    {
        $provinceId = request('province_id');
        $city = Province::findProvince($provinceId, ['cities'])
            ->cities->sortBy('name')
            ->pluck('name', 'id');

        return view('laravolt.city', compact('city'));
    }

    public function showDistrict()
    {
        $cityId = request('city_id');
        $district = City::findCity($cityId, ['districts'])
            ->districts->sortBy('name')
            ->pluck('name', 'id');

        return view('laravolt.district', compact('district'));
    }
    public function showVillage()
    {
        $districtId = request('district_id');
        $village = District::findDistrict($districtId, ['villages'])
            ->villages->sortBy('name')
            ->pluck('name', 'id');

        return view('laravolt.village', compact('village'));
    }
}
