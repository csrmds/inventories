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

    public function getLdapUser() {

        $ldapUser= AdUser::where('samaccountname', $this->name)->first();
        if ($ldapUser && $this->guid===$ldapUser->getconvertedguid()) {
            return $ldapUser;
        } else {
            return null;
        }

    }

    public function getPeople()
    {
        
    }
}
