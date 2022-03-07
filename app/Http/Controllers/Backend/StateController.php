<?php

namespace App\Http\Controllers\Backend;

use App\Models\State;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StateStoreRequest;
use App\Http\Requests\StateUpdateRequest;

class StateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $searchValue ='';

        $states = State::paginate(10);

        return view('states.index',compact('states', 'searchValue'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries['data'] =    Country::orderby("name","asc")  // prepared for AJAX also
                                ->select('id','name')
                                ->get();


        return view('states.create', compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StateStoreRequest $request)
    {
        $country = Country::findOrFail($request->country_id);

        $country->states()->create([
            'name'=> $request->name
        ]);

        $notifications = array(
            'type'=>'success',
            'title'=>__('State Management'),
            'message'=>__('State successfully stored to database.')
        );
        return redirect()->route('states.index')->with('notifications', array($notifications));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(State $state)
    {
        $countryId = $state->country->id;
        $countries['data'] = Country::all();
        return view('states.edit', compact('state','countryId','countries'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StateUpdateRequest $request, State $state)
    {

        $state->update(
            [
                'country_id' => $request->country_id,
                'name' => $request->name
            ]
        );
        $notifications = array(
            'type'=>'success',
            'title'=>__('State Management'),
            'message'=>__('State Data updated.')
        );
        return redirect()->route('states.index')->with('notifications', array($notifications));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(State $state)
    {
        $state->delete();
        $notifications = array(
            'type'=>'success',
            'title'=>__('State Management'),
            'message'=>__('State successfully deleted.')
        );
        return redirect()->route('states.index')->with('notifications',array($notifications));
    }
}
