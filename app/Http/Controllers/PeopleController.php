<?php

namespace App\Http\Controllers;

use App\Models\People;
use Illuminate\Http\Request;
use Illuminate\Support\Facedes\DB;
use Faker\Factory;

class PeopleController extends Controller
{
    private $people;

    public function __construct() {
        $this->people= new People;
    }


    public function index()
    {
        $people= People::all();

        return view('people.index', compact('people'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show(People $people)
    {
        echo "<p>Eita</p>";
    }


    public function edit(People $people)
    {
        //
    }


    public function update(Request $request, People $people)
    {
        //
    }


    public function destroy(People $people)
    {
        //
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

            $this->people->save();
        }
        echo "</pre>";
    }
}
