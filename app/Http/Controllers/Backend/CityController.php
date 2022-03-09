<?php

namespace App\Http\Controllers\Backend;

use App\Models\City;
use App\Models\State;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CityStoreRequest;
use App\Http\Requests\CityUpdateRequest;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request){

        if($request->filled('search') && !$request->has('resetsearch') && $request->has('searchbutton') ){ // if search button was pressed and search field is filled
            $cities = City::where('name','like',"%{$request->search}%")->orderBy('name')->paginate(10);
            $searchValue = $request->search;
        }else{
            $cities = City::orderBy('name')->paginate(10);
            $searchValue='';
        }

        return view('cities.index',compact('cities', 'searchValue'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries['data']  =    Country::orderby("name","asc")  // prepared for AJAX also
                                ->select('id','name')
                                ->get();

        $states['data']     =    State::orderby("name","asc")  // prepared for AJAX also
                                ->select('id','name')
                                ->get();


        return view('cities.create', compact('countries', 'states'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCityRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CityStoreRequest $request)
    {
        $state = State::findOrFail($request->state_id); // was already checked by FormRequest anyway

        $state->cities()->create([
            'name' => $request->name
        ]);

        $notifications = array(
            'type'=>'success',
            'title'=>__('City Management'),
            'message'=>__('City successfully stored to database.')
        );
        return redirect()->route('cities.index')->with('notifications', array($notifications));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function show(City $city)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function edit(City $city)
    {
        $currentState = $city->state;
        $currentCountry = $currentState->country;

        $countries = Country::all();
        $states = $currentCountry->states;
        return view('cities.edit', compact('countries','states','city','currentState','currentCountry'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCityRequest  $request
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function update(CityUpdateRequest $request, City $city)
    {
        $StateToAssociate = State::find($city->state->id);
        $city->state()->associate($StateToAssociate);
        $city->name = $request->name;
        $city->save();

        $notifications = array(
            'type'=>'success',
            'title'=>__('City Management'),
            'message'=>__('City successfully updated.')
        );
        return redirect()->route('cities.index')->with('notifications', array($notifications));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(City $city)
    {
        $city->delete();

        $notifications = array(
            'type'=>'success',
            'title'=>__('City Management'),
            'message'=>__('City successfully deleted.')
        );
        return redirect()->route('cities.index')->with('notifications',array($notifications));
    }
}
