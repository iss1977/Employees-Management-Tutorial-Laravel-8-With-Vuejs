<?php

namespace App\Http\Controllers\Api;

use App\Models\State;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EmployeeDataController extends Controller
{
    public function countries(){
        $countries = Country::select('id','name')->get();
        return response()->json($countries);
    }

    public function states(Country $country){
        $states = $country->states()->select('id','name')->get();
        $response = response()->json($states);
        return $response;
    }

    public function cities(State $state){
        $cities = $state->cities()->select('id','name')->get();
        return response()->json($cities);
    }
}
