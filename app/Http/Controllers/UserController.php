<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function signup(Request $request, $id){
        if ($id === "3") {
            $userData = $request->all();
            $validator = Validator::make($userData, [
                'email' => 'required|unique:users|email:rfc,dns,filter|max:50',
                'name' => 'required|max:30',
                'password' => 'required|max:50',
                'telephone' => 'required|min:16',
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
            $user->foundation_date = now();
            $user->signup_date = now();
            $user->save();
            
        } else {
            $userData = $request->all();
            $validator = Validator::make($userData, [
                'email' => 'required|unique:users|email:rfc,dns,filter|max:50',
                'name' => 'required|max:30',
                'password' => 'required|max:50',
                'telephone' => 'required|min:16',
                'found' => 'required|min:10',
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

            $user = new User();
            $user->name = $userData['name'];
            $user->email = $userData['email'];
            $user->password = bcrypt($userData['password']);
            $user->role_id = $id;
            $user->wallet_id = $wallet->id;
            $user->telephone = $userData['telephone'];
            $user->avatar = $request->file('avatar')->store('img/avatars');
            $user->foundation_date = $userData['found'];
            $user->signup_date = now();
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

    public function personalsettings(Request $request){
        $userData = $request->all();
        $validator = Validator::make($userData, [
            'email' => 'required|email:rfc,dns,filter|max:50',
            'name' => 'required|max:30',
            'telephone' => 'required|min:16',
            'avatar' => 'image|mimes:png,jpeg,jpg',
        ]);

        if ($validator->fails()){
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::findOrFail(Auth::id());
        $user->name = $userData['name'];
        $user->email = $userData['email'];
        $user->telephone = $userData['telephone'];
        if($request->file('avatar')){
            $user->avatar = $request->file('avatar')->store('img/avatars');
        }
        $user->save();

        return back();
    }

    public function passwordsettings(Request $request){
        $passwordData = $request->all();
        $validator = Validator::make($passwordData, [
            'newpassword' => 'required|max:50',
            'repeatpassword' => 'required|max:50',
        ]);

        if ($validator->fails()){
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        if($passwordData['newpassword'] === $passwordData['repeatpassword']){
            $user = User::findOrFail(Auth::id());
            $user->password = bcrypt($passwordData['newpassword']);
            $user->save();
        } else {
            return back()
                ->withErrors(['password_error'=>'Неверный пароль'])
                ->withInput();
        }

        return back();
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }
}
