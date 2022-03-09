<?php

namespace App\Http\Controllers\Ajax;

use App\Models\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StatesAjaxController extends Controller
{
    public function ajaxGetStatesOfCountry(Request $request)
    {
        $country = Country::find($request->countryId);
        $states = $country->states;
        return response()->json(['states'=>$states]);
    }
}
