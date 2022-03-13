<?php

namespace App\Http\Controllers\Api;

use App\Models\State;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeStoreRequest;
use App\Models\Department;
use App\Models\Employee;

class EmployeeDataController extends Controller
{
    public function countries(){
        $countries = Country::select('id','name')->get();
        return response()->json($countries);
    }

    public function states(Country $country){
        $states = $country->states()->select('id','name')->get();
        return response()->json($states);
    }

    public function cities(State $state){
        $cities = $state->cities()->select('id','name')->get();
        return response()->json($cities);
    }

    public function departments(){
        $departments = Department::all();
        return response()->json($departments);
    }

    public function create(EmployeeStoreRequest $request){
        $employee = Employee::create($request->validated());
        return response()->json($employee);
    }

}
