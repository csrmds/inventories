<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\People;
use Illuminate\Support\Facades\Auth;
use LdapRecord\Models\ActiveDirectory\User as LdapUser;
use LdapRecord\Models\ActiveDirectory\Group as LdapGroup;

use LdapRecord\Container;
use LdapRecord\Connection;

class TesteController extends Controller
{
    public function teste(Request $request)
    {
    //     $connection = new Connection([
    //         'hosts'    => [env('LDAP_HOST'), '127.0.0.1'],
    //         'username' => env('LDAP_USERNAME'),
    //         'password' => env('LDAP_PASSWORD'),
    //         'base_dn'=> env('LDAP_BASE_DN')
    //    ]);
       //$connection->connect();
       $groups= new LdapGroup;
       $users= LdapUser::where('samaccountname', 'contains', 'c')->get();
       //$results= $users->select(['cn', 'samaccountname', 'telephone', 'mail', 'memberof'])->get();
       //$results= $users->select(['cn', 'samaccountname', 'telephone', 'mail', 'memberof'])->where('samaccountname', 'contains', 'ad')->get();
       //$results= $groups->get();
       
       return json_encode($users);
       //$results = $connection->query()->where('samaccountname', '=', 'kalebe.malta')->get();
       
    //    echo "<pre>";
    //    foreach ($results as $key => $value) {
    //        //echo $key[0]." -> ".$value[0]."<br/>";
    //        print_r($value)."<br>";
    //    }
    //    echo "<pre>";
       //return json_encode($results);
        // $data= $request->all();

        // $users= LdapUser::get(); 
        //$users->where('samaccountname', '=', 'cesar.melo');


    }

    public function createUser() {
        $user= new User;

        $user->name="Cesar Santos";
        $user->email="csrmds@gmail.com";
        $user->password= password_hash("cesar", PASSWORD_DEFAULT);

        $user->save();

        return json_encode($user);
    }

    // public function ldapLogin(Request $request) {
    //     $credentials = [
    //         'samaccountname' => 'cesar.melo',
    //         'password' => 'Seven@1010',
    //     ];
        
    //     try {
    //         Auth::attempt($credentials);
    //         $user= Auth::user();

    //         return json_encode($user);
    //     } catch (\Exception $e) {
    //         return json_encode($e->getMessage());
    //     };
    // }

    public function dbLogin(Request $request) {
        $credentials = [
            'email' => 'csrmds@gmail.com',
            'password' => 'cesar',
        ];
        
        try {
            Auth::attempt($credentials);
            $user= Auth::user();

            return json_encode($user);
        } catch (\Exception $e) {
            return json_encode($e->getMessage());
        };

    }
}
