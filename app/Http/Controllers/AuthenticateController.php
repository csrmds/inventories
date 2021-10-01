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

        //$user= (new User)->where('email','lucas@gmail.com');
        //$user= (new User)->where('email', 'csrmds@gmail.com')->get()->toArray();

        //buscar login por email
        $user= (new User)->where('email', $data['login'])->get();
        
        //dd($user[0]->password);

        if (!empty($user[0])) {
            //obter dados e validar senha
            if ($user[0]->password== password_hash($data['password'], PASSWORD_DEFAULT)) {
                //salvar session e redirecionar para home
                session([
                    'authenticate'=>[
                        'userLogin'=> $user->name,
                        'userEmail'=> $user->email
                    ]
                ]);

                echo "Usuário autenticado com sucesso<br/>";

            }
        } else {
            echo "Usuário ou senha inválidos<br/>";
        }

        


        


        // echo $user->name."<br/>";
        // echo $user->email."<br/>";
        // echo $user->password."<br/>";
        // echo "Atributes: ".$user->attributtes;
        echo "<pre>";
        //print_r(Session::all());
        
        echo "</pre>";
        dd($user);
        //return json_encode($dados);
    }
}
