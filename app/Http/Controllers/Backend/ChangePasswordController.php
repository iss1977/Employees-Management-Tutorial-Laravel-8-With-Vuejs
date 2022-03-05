<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    public function changePassword (Request $request, User $user){
        $request->validate([
            'password' => ['required', 'string', 'min:4', 'confirmed']
        ]);

        $user->update([
            'password' => Hash::make($request->password)
        ]);

        $notifications = array(

            'type'=>'success',
            'title'=>__('User Management'),
            'message'=>__('User password successfully updated.')
        );

        return redirect()->route('users.index')->with('notifications', array($notifications));
    }
}
