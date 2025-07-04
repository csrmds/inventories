<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use LdapRecord\Models\Model;
use LdapRecord\Laravel\Auth\LdapAuthenticatable;
use LdapRecord\Laravel\Auth\AuthenticatesWithLdap;
use LdapRecord\Models\ActiveDirectory\User as AdUser;

class LdapUser extends Authenticatable implements LdapAuthenticatable
{
    use HasFactory, Notifiable, AuthenticatesWithLdap;

    protected $fillable= [
        'name', 'email', 'password', 'people_id', 'guid', 'domain'
    ];

    protected $hidden= [
        'password', 'remember_token'
    ];

    public static $objectClasses = [
        'top',
        'person',
        'organizationalperson',
        'user',
    ];

    //verificar se o usuário selecionado no banco tem o mesmo GUID do usuario do AD
    public function checkGuid(Request $request)
    {
        $ldapUser= AdUser::where('samaccountname', $this->name)->first();
        if ($ldapUser && $ldapUser->getconvertedguid()===$this->guid) {
            return true;
        } else {
            return false;
        }
    }

}
