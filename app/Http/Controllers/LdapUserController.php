<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\LdapUser;
use Illuminate\Support\Facades\Hash;

class LdapUserController extends Controller
{
    use AuthenticatesUsers;

    // protected function authenticated(Request $request, $user)
    // {
    //     return view('people');
    // }

    public function username()
    {
        return 'name';
    }

    public function home()
    {
        return view('ldap.home');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('name', 'password');

        if (Auth::guard('ldapusers')->attempt($credentials)) {
            Auth::logout();
            $request->session()->regenerate();
            $ldapUser= Auth::guard('ldapusers')->user();
            session()->put('userLogin', [
                'id'=> $ldapUser->id,
                'name'=> $ldapUser->name,
                'email'=> $ldapUser->email,
                'people_id'=> $ldapUser->people_id,
                'guard'=> "ldapusers"
            ]);

            return redirect()->route('people.index');
        } else {
            $msg= "Não foi possível autenticar...";
            return back()->withInput()->with('loginError', $msg);
        }

    }

    public function teste(Request $request)
    {
        $userLogin= Auth::user();
        $userLdapLogin= Auth::guard('ldapusers')->user();

        // echo "<pre>";
        // echo "USER LOGIN: <BR>";
        // print_r($userLogin)
        // echo "<br/><br/><br/>";
        // echo "USER LOGIN: <BR>";
        // print_r($userLogin)
        // echo "</pre>";

        return json_encode([$userLogin, $userLdapLogin]);

        // if (session('userLogin')) {
        //     return json_encode(session('userLogin'));
        // } else {
        //     return "sem userLdapLogin";
        // }
        // $ldapUser= new LdapUser;

        // $ldapUser->name= "cesar.ldap";
        // $ldapUser->password= Hash::make('ldap');
        // $ldapUser->email= "cesar.ldap@cmelos.com.br";

        // try {
        //     $ldapUser->save();
        //     return json_encode($ldapUser);
        // } catch(\Exception $e) {
        //     return $e->getMessage();
        // }
    }

    public function logout() {
        if (Auth::guard('ldapusers')->check()) {
            Auth::guard('ldapusers')->logout();
            session()->forget('userLogin');
            return view('ldap.login');
        }
    }


}
