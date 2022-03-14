<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\State;
use App\Models\Country;
use App\Models\Employee;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * This class is used to answer api requests from the Index, Create and Edit Vue components.
 */
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

    /**
     * Used to populate all the Edit Employee component :
     *  - countries
     *  - states of selected country
     *  - cities of selected state
     *  - complete employee data
     */
    public function entireEmployeeData(Employee $employee){
        $employeeData = array();

        try{
            // all countries are needed
            $countries = Country::select('id','name')->get();
            $employeeData['countries'] = $countries;

            // all states from the employees country are needed
            $states = $employee->country()->first()->states()->select('id','name')->get();
            $employeeData['states'] = $states;

            // all cities from the employees state are needed
            $cities = $employee->state()->first()->cities()->select('id','name')->get();
            $employeeData['cities'] = $cities;

            // all departments are needed
            $departments = Department::select('id','name')->get();
            $employeeData['departments'] = $departments;

            // finally, add the employee
            $employeeData['employee'] = $employee;

            // return message and code
            $returnStatus = 200;
            $returnStatusText = "OK";

        } catch (Exception $e){
            $returnStatus = 500;
            $returnStatusText = $e->getMessage();
        }

        $employeeData['message'] = $returnStatusText;
        return response()->json($employeeData,$returnStatus);
    }

}
