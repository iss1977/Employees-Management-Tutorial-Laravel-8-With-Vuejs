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
    public function index()
    {
        $request = request();


        $notifications=[
            [
                'type'=>'success',
                'title'=>'Title',
                'message'=>'Everything fine'
            ],
            [
                'type'=>'danger',
                'message'=>'Better as last tine'
            ],
            [
                'type'=>'warning',
                'message'=>'This is a warning maessage'
            ],
            [
                'type'=>'info',
                'message'=>'This is an info message'
            ],
            [
                'type'=>'notexisting',
                'message'=>'Gone wrong'
            ],


        ];


        // $request->session()->put('hello', 'trocadello');
        //$request->session()->put('array2sendtoview', $array2send);

        $users = User::all();
        return view('users.index', compact('users','request','notifications'));
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
        return redirect()->route('users.index')->with('message',__('User registered succesfully'));
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
        return redirect()->route('users.index')->with('toastNotifications',[
            'message' => __('User updated succesfully'),
            'status' => 'ON'
        ]);
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
            return redirect()->route('users.index')->with('warning',__('You can not delete your own account'));
        }
        $user->delete();
        return redirect()->route('users.index')->with('success',__('User deleted succesfully'));

    }
}
