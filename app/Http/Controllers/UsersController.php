<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function register(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
//            echo "<pre>"; print_r($data); die;
            $usersCount = User::where('email' , $data['email'])->count();
            if($usersCount > 0){
                return redirect()->back()->with('flash_message_error', 'Email Already Exits');
            } else {
                echo "Success";
            }
        }
        return view ('users.login_register');
    }
}
