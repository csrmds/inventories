<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\People;

class TesteController extends Controller
{
    public function teste(Request $request)
    {
        $user= User::find('1');
        $people= People::find('10');
        $x= $user->getPeople()->get();
        $y= $people->getUser()->get();

        return json_encode($y);
    }

    public function createUser() {
        $user= new User;

        $user->name="Cesar Santos";
        $user->email="csrmds@gmail.com";
        $user->password= password_hash("cesar", PASSWORD_DEFAULT);

        $user->save();

        return json_encode($user);
    }
}
