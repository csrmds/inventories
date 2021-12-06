<?php

namespace App\Http\Controllers;

use App\Models\People;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Group;
use App\Models\User;
use App\Models\LdapUser;
use Illuminate\Support\Facades\Auth;
//use LdapRecord\Models\ActiveDirectory\User as LdapUser;
use Faker\Factory;

class PeopleController extends Controller
{
    private $people;
    private $ufs;

    public function __construct() {
        $this->people= new People;
        $this->ufs= [
            ["codUf"=> 11, "nome"=> "Rondônia", "uf"=> "RO"],
            ["codUf"=> 12, "nome"=> "Acre", "uf"=> "AC"],
            ["codUf"=> 13, "nome"=> "Amazonas", "uf"=> "AM"],
            ["codUf"=> 14, "nome"=> "Roraima", "uf"=> "RR"],
            ["codUf"=> 15, "nome"=> "Pará", "uf"=> "PA"],
            ["codUf"=> 16, "nome"=> "Amapá", "uf"=> "AP"],
            ["codUf"=> 17, "nome"=> "Tocantins", "uf"=> "TO"],
            ["codUf"=> 21, "nome"=> "Maranhão", "uf"=> "MA"],
            ["codUf"=> 22, "nome"=> "Piauí", "uf"=> "PI"],
            ["codUf"=> 23, "nome"=> "Ceará", "uf"=> "CE"],
            ["codUf"=> 24, "nome"=> "Rio Grande do Norte", "uf"=> "RN"],
            ["codUf"=> 25, "nome"=> "Paraíba", "uf"=> "PB"],
            ["codUf"=> 26, "nome"=> "Pernambuco", "uf"=> "PE"],
            ["codUf"=> 27, "nome"=> "Alagoas", "uf"=> "AL"],
            ["codUf"=> 28, "nome"=> "Sergipe", "uf"=> "SE"],
            ["codUf"=> 29, "nome"=> "Bahia", "uf"=> "BA"],
            ["codUf"=> 31, "nome"=> "Minas Gerais", "uf"=> "MG"],
            ["codUf"=> 32, "nome"=> "Espírito Santo", "uf"=> "ES"],
            ["codUf"=> 33, "nome"=> "Rio de Janeiro", "uf"=> "RJ"],
            ["codUf"=> 35, "nome"=> "São Paulo", "uf"=> "SP"],
            ["codUf"=> 41, "nome"=> "Paraná", "uf"=> "PR"],
            ["codUf"=> 42, "nome"=> "Santa Catarina", "uf"=> "SC"],
            ["codUf"=> 43, "nome"=> "Rio Grande do Sul", "uf"=> "RS"],
            ["codUf"=> 50, "nome"=> "Mato Grosso do Sul", "uf"=> "MS"],
            ["codUf"=> 51, "nome"=> "Mato Grosso", "uf"=> "MT"],
            ["codUf"=> 52, "nome"=> "Goiás", "uf"=> "GO"],
            ["codUf"=> 53, "nome"=> "Distrito Federal", "uf"=> "DF"]
        ];
    }

    protected function setProperties($properties) {
        $this->people->first_name= $properties['first_name'];
        $this->people->last_name= $properties['last_name'];
        $this->people->nick_name= $properties['nick_name'];
        $this->people->type= $properties['type'];
        $this->people->birth_date= $properties['birth_date'];
        $this->people->category= $properties['category'];
        $this->people->zipcode= $properties['zipcode'];
        $this->people->country= $properties['country'];
        $this->people->state= $properties['state'];
        $this->people->city= $properties['city'];
        $this->people->district= $properties['district'];
        $this->people->address= $properties['address'];
        $this->people->number= $properties['number'];
        $this->people->complement= $properties['complement'];
        $this->people->rg= $properties['rg'];
        $this->people->cpf= $properties['cpf'];
        $this->people->cnpj= $properties['cnpj'];
        $this->people->ie= $properties['ie'];
        $this->people->sistema= $properties['sistema'] ? $properties['sistema'] : 0;
    }


    public function index()
    {
        $people= People::all();
        $ufs= $this->ufs;

        return view('people.index', compact('people', 'ufs'));
    }


    public function save(Request $request)
    {
        $people= $request->input('people');
        $ldapUser= $request->input('ldapUser');
        
        $this->setProperties($people);
        
        try {
            $this->people->save();

            if ($ldapUser) {
                //atualiza usuario na tabela users
                $user= DB::table('ldap_users')
                ->where('guid', '=', $ldapUser['objectguid'])
                ->update([
                    'name'=> $ldapUser['samaccountname'],
                    'email'=> $ldapUser['mail'],
                    'people_id'=> $this->people->id,
                    'domain'=> 'default',
                    'updated_at'=> now()
                ]);

                if ($user==0) {
                    //cria novo usuario na tabela users
                    $user= new LdapUser;
                    $user->name= $ldapUser['samaccountname'];
                    $user->email= $ldapUser['mail'];
                    $user->people_id= $this->people->id;
                    $user->guid= $ldapUser['objectguid'];
                    $user->domain= 'default';
                    $user->save();
                }  
            }

            return response(json_encode($this->people));
        } catch(\Exception $e) {
            return response(json_encode($e->getMessage()), 418);
        }
    }


    public function update(Request $request, People $people)
    {
        $people= $request->input('people');
        $ldapUser= $request->input('ldapUser');

        //criar condição para verificar se já existe um usuario para o ID da pessoa

        if ($ldapUser) { 
            //atualiza usuario na tabela users
            $user= DB::table('ldap_users')
            ->where('guid', '=', $ldapUser['objectguid'])
            ->update([
                'name'=> $ldapUser['samaccountname'],
                'email'=> $ldapUser['mail'],
                'people_id'=> $people['id'],
                'domain'=> 'default',
                'updated_at'=> now()
            ]);
            
            if ($user==0) {
                //cria novo usuario na tabela users
                $user= new LdapUser;
                $user->name= $ldapUser['samaccountname'];
                $user->email= $ldapUser['mail'];
                $user->people_id= $people['id'];
                $user->guid= $ldapUser['objectguid'];
                $user->domain= 'default';
                try {
                    $user->save();
                } catch(\Exception $e) {
                    return response(json_encode($e->getMessage()), 418);
                }
                
            }  
        }

        $this->people= People::Find($people['id']);
        $this->setProperties($people);

        try {
            $this->people->save();
            return response(json_encode($this->people));
        } catch(\Exception $e) {
            return response(json_encode($e->getMessage()), 418);
        }
    }

    public function removeLdapUser(Request $request)
    {
        //$id= $request->input('id');
        $ldapUser= $request->input('ldapUser');

        try {
            $removeUser= DB::table('ldap_users')->where('guid', $ldapUser['objectguid'])->delete();
            return json_encode($removeUser);
        } catch (\Exception $e) {
            return json_encode($e->getMessage());
        }
        
    }


    public function destroy(Request $request)
    {   
        $id= $request->input('id');
        
        try {
            People::destroy($id);
            return response(json_encode(["msg"=>"Registro deletado com sucesso"]));
        }catch(\Exception $e) {
            return response(json_encode($e->getMessage()), 418) ;
        }
    }

    public function search(Request $request)
    {
        $data= $request->input('word');
        
        $people= DB::table('people')
            ->where('first_name', 'like', $data.'%')
            ->orWhere('last_name', 'like', $data.'%')
            ->orWhere('nick_name', 'like', $data.'%')
            ->paginate(10);
        
        return json_encode($people);
    }

    public function searchBy(Request $request)
    {
        $data= $request->all();
        $people= DB::select("select *, {$data['column']} as 'column' from people where {$data['column']} like '{$data['word']}%'");

        return json_encode($people);
    }

    public function getById(Request $request)
    {
        $id= $request->input('id');
        $people= DB::table('people')->where('id', $id)->get();

        return json_encode($people);
    }

    public function listCategory()
    {
        $category= DB::table('groups')->where('table', 'people_category')->get();
        return json_encode($category);
    }

    public function getUser(Request $request)
    {
        $id= $request->input('id');
        $people= People::find($id);
        $user= $people->getUser()->first();
        //dd($id);

        return json_encode($user);
    }

    public function faker() {
        
        $faker= Factory::create('pt_BR');

        echo "<pre>";
        for ($i=0; $i<100; $i++) {
            $this->people= new People;
            
            $this->people->first_name= $faker->firstName;
            $this->people->last_name= $faker->lastName;
            $this->people->type= $faker->randomElement(['F','J']);
            $this->people->category= $faker->randomElement(['CLIENTE','COLABORADOR','FORNECEDOR','USUÁRIO','OUTROS']);
            $this->people->zipcode= $faker->postcode;
            $this->people->birth_date= $faker->date('Y-m-d');
            $this->people->country= "BRASIL";
            $this->people->state= $faker->stateAbbr;
            $this->people->city= $faker->city;
            $this->people->district= $faker->words(2, true);
            $this->people->address= $faker->streetName;
            $this->people->number= $faker->buildingNumber;
            $this->people->cpf= $faker->cpf;

            //print_r($this->people);

            //$this->people->save();
        }
        echo "</pre>";
    }
}
