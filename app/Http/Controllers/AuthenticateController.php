<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\People;
use App\Models\User;


class AuthenticateController extends Controller
{
    public function login(Request $request) {
        $data= $request->all();
        $user= new User;
        $return= [];

        $count= count($user->where('name', $data['login'])->get());
        if ($count>0) {
            $userLogin= $user->where('name', $data['login'])->get();

            if(password_verify($data['password'], $userLogin[0]->password)) {
                //echo "senha bateu: <br/>";
                session()->put(
                    'userLogin', [
                        'id'=> $userLogin[0]->id,
                        'name'=> $userLogin[0]->name,
                        'email'=> $userLogin[0]->email
                ]);
                $return= session()->get('userLogin');
                $return["error"]= false;

            } else {
                $return= [
                    "error"=> true,
                    "msg"=> "Usuário ou senha inválido"
                ];
            }
            
        } else {
            $return= [
                "error"=> true,
                "msg"=> "Usuário ou senha inválido"
            ];
        };

        return json_encode($return);

    }

    public function logout() {
        if (session()->has('userLogin')) {
            session()->forget('userLogin');
        }

        return redirect('/');
    }

    public function teste() {
        $user= new User;

        $user->name= "Eduardo";
        $user->email= "eduardo@gmail.com";
        $user->password= password_hash("eduardo", PASSWORD_DEFAULT);

        $user->save();

        echo "<pre>";
        dd($user);
        echo "</pre>";
    }
}
