<?php

namespace App\Http\Controllers;
use App\Models\Cities;

class CityController extends Controller
{
    public function getCities($country_id)
    {
        $cities = Cities::where('country_id', $country_id)->get();
        return response()->json($cities);
    }
}