<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use LdapRecord\Models\ActiveDirectory\User as LdapUser;
use LdapRecord\Models\ActiveDirectory\Group as LdapGroup;
use LdapRecord\Models\ActiveDirectory\Entry;
use LdapRecord\Models\ActiveDirectory\Computer;
use LdapRecord\Models\ActiveDirectory\OrganizationalUnit;
use LdapRecord\Models\ActiveDirectory\Container;
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
                $users= LdapUser::where('samaccountname', 'contains', $word)->get();
            } else {
                $users= LdapUser::get();
            }
            return json_encode($users);
        } catch (\Exception $e){
            return response(json_encode($e->getMessage()), 418);
        }
        
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
