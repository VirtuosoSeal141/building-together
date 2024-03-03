<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\PasswordReset;
use App\Models\User;
use App\Models\View;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

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

    public function forgetpassword(Request $request) {
        $userData = $request->only('email');

        $validator = Validator::make($userData, [
            'email'=>'required|email:rfc,dns,filter',
        ]);

        if ($validator->fails()){
            return redirect(route('forgetpassword-page'))
                ->withErrors($validator)
                ->withInput();
        }

        $oldReset = PasswordReset::where('email', $userData['email'])->first();
        if ($oldReset !== null){
            $oldReset->delete();
        }

        if (User::where('email', $userData['email'])->first() !== null) {
            $token = Str::random(64);

            $reset = new PasswordReset();
            $reset->email = $userData['email'];
            $reset->token = $token;
            $reset->save();

            Mail::send('reset-password-email', ['token' => $token, 'email' => $request->email], function($message) use($request){
                $message->to($request->email);
                $message->subject('Reset Password');
            });

            return back()->with('message', 'Письмо отправлено на почту!');
        }

        return back()
            ->withErrors(['email_error'=>'Данного пользователя не существует'])
            ->withInput();
    }

    public function resetpassword(Request $request) {
        $userData = $request->only('email', 'token', 'password');

        $validator = Validator::make($userData, [
            'email'=>'required|email:rfc,dns,filter',
            'token'=>'required',
            'password'=>'required',
        ]);

        if ($validator->fails()){
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        if(PasswordReset::where(['email' => $userData['email'], 'token' => $userData['token']])->first() == null){
            return back()
                ->withErrors(['post_error'=>'Данные некорректны или неактуальны'])
                ->withInput();
        }

        $user = User::where('email', $userData['email'])->first();
        if ($user !== null){
            $user->password = bcrypt($userData['password']);
            $user->save();

            PasswordReset::where(['email' => $userData['email']])->delete();

            return redirect(route('login-page'))->with('message', 'Пароль обновлен!');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }
}
