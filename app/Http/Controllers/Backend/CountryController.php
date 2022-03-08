<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CountryStoreRequest;
use App\Http\Requests\CountryUpdateRequest;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function index(Request $request){

        if($request->filled('search') && !$request->has('resetsearch') && $request->has('searchbutton') ){ // if search button was pressed and search field is filled
            $countries = Country::where('country_code','like',"%{$request->search}%")->orWhere('name','like',"%{$request->search}%")->paginate(10);
            $searchValue = $request->search;
        }else{
            $countries = Country::paginate(10);
            $searchValue='';
        }
        return view('countries.index',compact('countries', 'searchValue'));
    }

        /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('countries.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CountryStoreRequest $request){
        Country::create([
            'country_code' => $request->country_code,
            'name' => $request->name
        ]);

        $notifications = array(
            'type'=>'success',
            'title'=>__('Country Management'),
            'message'=>__('Country successfully stored to database.')
        );
        return redirect()->route('countries.index')->with('notifications', array($notifications));
    }

     /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Country $country){
        return view('countries.edit', compact('country'));
    }

        /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CountryUpdateRequest $request, Country $country)
    {

        // See if the new country code doesn't exist in the database //
        if ((Country::where('country_code',$request->country_code)->where('id','!=',$country->id)->limit(2)->count()) > 0){
            $notifications = array(
                'type'=>'warning',
                'title'=>__('Country Management'),
                'message'=>__('This country code already exists.')
            );
            return redirect()->route('countries.index')->with('notifications',array($notifications));
        };

        $country->update(
            [
                'country_code' => $request->country_code,
                'name' => $request->name
            ]
        );
        $notifications = array(

            'type'=>'success',
            'title'=>__('Country Management'),
            'message'=>__('Country Data updated.')
        );
        return redirect()->route('countries.index')->with('notifications', array($notifications));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Country $country)
    {
        // if(auth()->user()->id == $user->id){
        //     $notifications = array(
        //         'type'=>'warning',
        //         'title'=>__('User Management'),
        //         'message'=>__('You can not delete your own account.')
        //     );
        //     return redirect()->route('users.index')->with('notifications',array($notifications));
        // }
        // $user->delete();
        $notifications = array(
            'type'=>'success',
            'title'=>__('User Management'),
            'message'=>__('Account successfully deleted.')
        );
        return redirect()->route('countries.index')->with('notifications',array($notifications));

    }

}
