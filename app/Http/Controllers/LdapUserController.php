<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use LdapRecord\Models\ActiveDirectory\User as LdapUser;
use LdapRecord\Models\Attributes\AccountControl;
use LdapRecord\Models\ModelNotFoundException;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
//use App\Models\LdapUser;
use LdapRecord\Container;

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
        $credentials= [
            'samaccountname'=> $request->input('name'),
            'password'=> $request->input('password'),
        ];

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

    public function logout() {
        if (Auth::guard('ldapusers')->check()) {
            Auth::guard('ldapusers')->logout();
            session()->forget('userLogin');
            return view('ldap.login');
        }
    }

    public function getLdapUser(Request $request) {
        $user= LdapUser::findBy('samaccountname', $request->input('samaccountname'));

        if ($user) {
            return json_encode($user);
        } else {
            return null;
        }

    }


    public function searchUser(Request $request)
    {
        $word= $request->input('word') ;

        try {
            if ($word!=null) {
                $users= LdapUser::where('iscriticalsystemobject', '!=', 'TRUE')
                    ->where('samaccountname', 'contains', $word)
                    ->orWhere('cn', 'contains', $word)->get();
            } else {
                $users= LdapUser::where('iscriticalsystemobject', '!=', 'TRUE')->get();
            }
            return json_encode($users);
        } catch (\Exception $e){
            return response(json_encode($e->getMessage()), 418);
        }
        
    }


    public function checkCred(Request $request) 
    {
        $samaccountname= $request->input('samaccountname');
        $password= $request->input('password');
        
        $connection = Container::getDefaultConnection();
        $ldapUser= LdapUser::where('name', $samaccountname)->first();
        //$ldapUser= LdapUser::where('samaccountname', $samaccountname)->first();
        dd($ldapUser);

        if ($ldapUser && $password && $connection->auth()->attempt($ldapUser->getDn(), $password)) {
            return true;
        } else {
            $message = $connection->getLdapConnection()->getDiagnosticMessage();
            if (strpos($message, '532') !== false) {
                return "Your password has expired.";
            }
            return false;
        }

    }

    public function teste(Request $request)
    {
        $word= $request->input('word');
        print_r($word);
        //$word= "lu";
        DB::enableQueryLog();
        try {
            if ($word!=null) {
                $users= LdapUser::where('iscriticalsystemobject', '!=', 'TRUE')
                    ->where('samaccountname', 'contains', $word)
                    ->orWhere('cn', 'contains', $word)->get();
                //dd(DB::getQueryLog());
            } else {
                $users= LdapUser::where('iscriticalsystemobject', '!=', 'TRUE')->get();
            }
            return json_encode($users);
        } catch (\Exception $e){
            return response(json_encode($e->getMessage()), 418);
        }

    }

    


}
