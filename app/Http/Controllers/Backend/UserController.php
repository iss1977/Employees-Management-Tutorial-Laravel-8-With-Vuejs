<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->filled('search') && !$request->has('resetsearch') && $request->has('searchbutton') ){ // if search button was pressed and search field is filled
            $users = User::where('username','like',"%{$request->search}%")->orWhere('email','like',"%{$request->search}%")->paginate(15);
            $searchValue = $request->search;
        }else{
            $users = User::paginate(10);
            $searchValue='';
        }
        return view('users.index', compact('users', 'searchValue'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStoreRequest $request)
    {
        User::create([
            'username' => $request->username,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $notifications = array(

            'type'=>'success',
            'title'=>__('User Management'),
            'message'=>__('User successfully created.')
        );
        return redirect()->route('users.index')->with('notifications', array($notifications));
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
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        $user->update(
            [
                'username' => $request->username,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email
            ]
        );
        $notifications = array(

            'type'=>'success',
            'title'=>__('User Management'),
            'message'=>__('User successfully updated.')
        );
        return redirect()->route('users.index')->with('notifications', array($notifications));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if(auth()->user()->id == $user->id){
            $notifications = array(
                'type'=>'warning',
                'title'=>__('User Management'),
                'message'=>__('You can not delete your own account.')
            );
            return redirect()->route('users.index')->with('notifications',array($notifications));
        }
        $user->delete();
        $notifications = array(
            'type'=>'success',
            'title'=>__('User Management'),
            'message'=>__('Account successfully deleted.')
        );
        return redirect()->route('users.index')->with('notifications',array($notifications));

    }
}
