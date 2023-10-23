<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function login(Request $request) {
        $userInfo = $request->only('email', 'password');

        $validator = Validator::make($userInfo, [
            'email'=>'required|email:rfc,dns,filter',
            'password'=>'required',
        ]);

        if ($validator->fails()) {
            return redirect(route('login-page'))
                ->withErrors($validator)
                ->withInput();
        }

        if (Auth::attempt($userInfo)){
            return redirect('/');
        }

        return redirect(route('login-page'))
            ->withErrors(['auth_error'=>'Email или пароль введены некорректно'])
            ->withInput();
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }
}
