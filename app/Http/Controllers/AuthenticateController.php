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
        $credentials= [
            "name"=> $request->input('user'),
            "password"=> $request->input('password')
        ];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $userLogin= Auth::user();
            session()->put('userLogin',[
                'name'=> $userLogin['name'],
                'email'=> $userLogin['email'],
                'id'=> $userLogin['id'],
                'people_id'=> $userLogin['people_id'],
                'domain'=> $userLogin['domain'],
                'guid'=> $userLogin['guid']
            ]);
            $response=[ "login"=> true ];
            return json_encode($response);
        } else {
            $response= [
                "login"=> false,
                "msg"=> "Falha ao validar o usuário"
            ];
            return json_encode($response);
        }
        
    }

    public function logout() {

        if (Auth::check()) {
            Auth::logout();
            session()->forget('userLogin');
        }

        return redirect()->route('login');
    }

    // public function loginOld(Request $request) {
    //     $data= $request->all();
    //     $user= new User;
    //     $return= [];

    //     $count= count($user->where('name', $data['login'])->get());
    //     if ($count>0) {
    //         $userLogin= $user->where('name', $data['login'])->get();

    //         if(password_verify($data['password'], $userLogin[0]->password)) {
    //             //echo "senha bateu: <br/>";
    //             session()->put(
    //                 'userLogin', [
    //                     'id'=> $userLogin[0]->id,
    //                     'name'=> $userLogin[0]->name,
    //                     'email'=> $userLogin[0]->email
    //             ]);
    //             $return= session()->get('userLogin');
    //             $return["error"]= false;

    //         } else {
    //             $return= [
    //                 "error"=> true,
    //                 "msg"=> "Usuário ou senha inválido"
    //             ];
    //         }
            
    //     } else {
    //         $return= [
    //             "error"=> true,
    //             "msg"=> "Usuário ou senha inválido"
    //         ];
    //     };

    //     return json_encode($return);

    // }

    // public function logoutOld() {
    //     if (session()->has('userLogin')) {
    //         session()->forget('userLogin');
    //     }

    //     return redirect('/');
    // }

    public function teste() {
        $user= new User;

        $user->name= "Marcia";
        $user->email= "marcia@gmail.com";
        $user->password= password_hash("marcia", PASSWORD_DEFAULT);

        $user->save();

        echo "<pre>";
        dd($user);
        echo "</pre>";
    }
}
