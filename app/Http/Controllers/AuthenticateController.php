<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\People;
use App\Models\User;

class AuthenticateController extends Controller
{
    public function login(Request $request) {
        $dados= $request->all();

        $user= (new People)->all();



        //buscar login por email
            //obter dados e validar senha
                //salvar session e redirecionar para home

        //_else: retornar msg de erro


        


        
        return json_encode($user);
    }
}
