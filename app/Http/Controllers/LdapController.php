<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use LdapRecord\Models\ActiveDirectory\User as LdapUser;
use LdapRecord\Models\ActiveDirectory\Group as LdapGroup;
use LdapRecord\Models\ActiveDirectory\Entry;
use LdapRecord\Models\ActiveDirectory\Computer;
use LdapRecord\Models\ActiveDirectory\OrganizationalUnit;
use LdapRecord\Models\ActiveDirectory\Container;
use LdapRecord\Models\Attributes\AccountControl;
use LdapRecord\Models\ModelNotFoundException;
use App\Models\User;
use App\Models\People;
use Illuminate\Support\Facades\Auth;

class LdapController extends Controller
{
    public function searchUser(Request $request)
    {
        $word= $request->input('word');

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

    public function teste(Request $request)
    {
        $user= LdapUser::where('samaccountname', 'luciana.mello')->first();

        $uac = new AccountControl($user->getFirstAttribute('userAccountControl'));


        // if ($uac->has(AccountControl::LOCKOUT)) {
        //     $user->contaBloqueada= true;
        // } else {
        //     $user->contaBloqueada= false;
        // };

        
        //$user= LdapUser::where('lockouttime', '>=', '1')->get();

        // if ($user->getFirstAttribute('lockouttime') > 0) {
        //     $user->contaBloqueada=true;
        // } else {
        //     $user->contrBloqueada= false;
        // }

        return json_encode($user);
    }

    public function searchGroup(Request $request)
    {
        $word= $request->input('word');

        try {
            if ($word!=null) {
                $groups= LdapGroup::where('samaccountname', 'contains', $word)->get();
            } else {
                $groups= LdapGroup::get();
            }
            return json_encode($groups);
        } catch (\Exception $e) {
            return response(json_encode($e->getMessage()), 418);
        }
    }
}
