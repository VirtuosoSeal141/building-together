<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use App\Models\View;
use Carbon\Carbon;
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

            $user = new User();
            $user->name = $userData['name'];
            $user->email = $userData['email'];
            $user->password = bcrypt($userData['password']);
            $user->role_id = $id;
            $user->balance = 0;
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

            $user = new User();
            $user->name = $userData['name'];
            $user->email = $userData['email'];
            $user->password = bcrypt($userData['password']);
            $user->role_id = $id;
            $user->balance = 0;
            $user->telephone = $userData['telephone'];
            $user->avatar = $request->file('avatar')->store('img/avatars');
            $user->foundation_date = Carbon::parse($userData['found']);
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

    public function plusbalance(Request $request){
        $walletData = $request->all();
        $validator = Validator::make($walletData, [
            'plus' => 'required',
        ]);

        if ($validator->fails()){
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $money = str_replace(' ','', str_replace(',','.', $walletData['plus']));

        if ($money <= 0){
            return back()->withErrors(['plus_error'=>'Некорректные данные']);
        }

        $user = User::findOrFail(Auth::id());
        $user->balance = $user->balance+$money;
        $user->save();

        return back();
    }

    public function minusbalance(Request $request){
        $walletData = $request->all();
        $validator = Validator::make($walletData, [
            'minus' => 'required',
        ]);

        if ($validator->fails()){
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $money = str_replace(' ','', str_replace(',','.', $walletData['minus']));

        if ($money <= 0){
            return back()->withErrors(['minus_error'=>'Некорректные данные']);
        }
        
        $user = User::findOrFail(Auth::id());

        if ($money > $user->balance){
            return back()
                ->withErrors(['minus_error'=>'Недостаточно средств'])
                ->withInput();
        }

        $user->balance = $user->balance-$money;
        $user->save();

        return back();
    }

    public function profilesettings(Request $request, $id){
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

        $user = User::findOrFail($id);
        $user->name = $userData['name'];
        $user->email = $userData['email'];
        $user->telephone = $userData['telephone'];
        if($request->file('avatar')){
            $user->avatar = $request->file('avatar')->store('img/avatars');
        }
        $user->save();

        return back();
    }

    public function passwordprofile(Request $request, $id){
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
            $user = User::findOrFail($id);
            $user->password = bcrypt($passwordData['newpassword']);
            $user->save();
        } else {
            return back()
                ->withErrors(['password_error'=>'Неверный пароль'])
                ->withInput();
        }

        return back();
    }

    public function delprofile($id){

        View::where('user_id', $id)->delete();
        Order::where('user2_id', $id)->delete();
        User::findOrFail($id)->delete();

        return back();
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }
}
