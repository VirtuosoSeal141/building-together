<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function  signup(Request $request, $id){
        if ($id === "3") {
            $userData = $request->all();
            $validator = Validator::make($userData, [
                'email' => 'required|unique:users|email:rfc,dns,filter|max:50',
                'name' => 'required|max:30',
                'password' => 'required|max:50',
                'telephone' => 'required|min:80000000000|numeric',
            ]);

            if ($validator->fails()){
                return back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $wallet = new Wallet();
            $wallet->balance = 0;
            $wallet->save();

            $user = new User();
            $user->name = $userData['name'];
            $user->email = $userData['email'];
            $user->password = bcrypt($userData['password']);
            $user->role_id = $id;
            $user->wallet_id = $wallet->id;
            $user->telephone = $userData['telephone'];
            $user->save();
            
        } else {
            $userData = $request->all();
            $validator = Validator::make($userData, [
                'email' => 'required|unique:users|email:rfc,dns,filter|max:50',
                'name' => 'required|max:30',
                'password' => 'required|max:50',
                'telephone' => 'required|min:80000000000|numeric',
                'found' => 'required',
                'avatar' => 'required|image|mimes:png,jpeg,jpg',
            ]);

            if ($validator->fails()){
                return back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $wallet = new Wallet();
            $wallet->balance = 0;
            $wallet->save();

            $avatar = $request->file('avatar')->store('img/avatars');

            $user = new User();
            $user->name = $userData['name'];
            $user->email = $userData['email'];
            $user->password = bcrypt($userData['password']);
            $user->role_id = $id;
            $user->wallet_id = $wallet->id;
            $user->telephone = $userData['telephone'];
            $user->avatar = $avatar;
            $user->foundation_date = $userData['found'];
            $user->save();
        }
        

        $userInfo = $request->only('email', 'password');

        if (Auth::attempt($userInfo)){

            return redirect('/');
        }
    }

    public function login(Request $request) {
        $userInfo = $request->only('email', 'password');

        $validator = Validator::make($userInfo, [
            'email'=>'required|email:rfc,dns,filter',
            'password'=>'required',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        if (Auth::attempt($userInfo)){
            return redirect('/');
        }

        return back()
            ->withErrors(['auth_error'=>'Email или пароль введены некорректно'])
            ->withInput();
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }
}
