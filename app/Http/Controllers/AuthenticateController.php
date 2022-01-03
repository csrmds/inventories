<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\People;
use App\Models\User;


class AuthenticateController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('name', 'password');

        if (Auth::attempt($credentials)) {
            Auth::guard('ldapusers')->logout();
            $request->session()->regenerate();
            $userLogin= Auth::user();
            session()->put('userLogin',[
                'id'=> $userLogin['id'],
                'name'=> $userLogin['name'],
                'email'=> $userLogin['email'],
                'people_id'=> $userLogin['people_id'],
                'guard'=> 'users'
            ]);

            return redirect()->route('people.index');
        } else {
            $msg= "Não foi possível autenticar...";
            return back()->withInput()->with('loginError', $msg);
        }   
    }


    public function logout() {
        if (Auth::check() || Auth::guard('ldapusers')->check()) {
            Auth::logout();
            Auth::guard('ldapusers')->logout();
            session()->forget('userLogin');
        }
        return redirect()->route('home');
    }


    public function teste() {
        $user= new User;

        $user->name= "Cesar Melo";
        $user->email= "cesar.melo@gmail.com";
        $user->password= password_hash("1234", PASSWORD_DEFAULT);

        $user->save();

        echo "<pre>";
        dd($user);
        echo "</pre>";
    }
}
