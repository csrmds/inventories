<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Group;
use Faker\Factory;


class ProductController extends Controller
{

    private $product;

    public function __construct() {
        $this->product= new Product;
    }

    protected function setProprieties($proprieties) {
        //$this->product->id= "cesar"; //$proprieties['id'];
        $this->product->name= $proprieties['name'];
        $this->product->reference= $proprieties['reference'];
        $this->product->description= $proprieties['description'];
        $this->product->type= $proprieties['type'];
        $this->product->category= $proprieties['category'];
        $this->product->manufacturer= $proprieties['manufacturer'];
        $this->product->brand= $proprieties['brand'];
        $this->product->model= $proprieties['model'];
        $this->product->sn= $proprieties['sn'];
        $this->product->tag= $proprieties['tag'];
        $this->product->property_id= $proprieties['property_id'];
        $this->product->size_id= $proprieties['size_id'];
        $this->product->color_id= $proprieties['color_id'];
        $this->product->um= $proprieties['um'];
        $this->product->status= $proprieties['status'];
        $this->product->obs= $proprieties['obs'];
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products= Product::all();

		return view('product.index', compact('products')); 
    }

    public function create() 
    {
        $type= DB::table('groups')->where('table', 'product_type')->get();
        $um= DB::table('groups')->where('table', 'product_um')->get();

        return view('product.create', compact('type','um'));
    }

    public function edit()
    {
		return view('product.index'); 
    }

    public function update(Request $request)
    {
        $this->product= Product::Find($request->input('id'));
        $this->setProprieties($request->all());

        try {
            $this->product->save();
            return response(json_encode($this->product));
        }catch(\Exception $e) {
            return response(json_encode($e->getMessage()), 418) ;
        }
        
    }

    public function destroy()
    {
		return view('product.index'); 
    }

    public function search(Request $request)
    {
        $data= $request->all();
        $products= DB::table('products')->where('name', 'like', $data['word'].'%')->get();

        return json_encode($products);
    }

    public function searchBy(Request $request)
    {
        $data= $request->all();
        //$products= DB::table('products')->select('*, '.$data['column'].' as column')->where($data['column'], 'like', $data['word'].'%')->get();
        $products= DB::select("select *, {$data['column']} as 'column' from products where {$data['column']} like '{$data['word']}%'");

        return json_encode($products);
    }

    public function searchByPropertyId(Resquest $request)
    {
        $data= $request->all();
        $products= DB::table('products')->where('property_id', 'like', $data['word'].'%')->get();

        return json_encode($products);
    }

    public function faker() 
    {
        
        $faker= Factory::create('pt_BR');
        //$faker::create('pt_BR');

        echo "<pre>";
        for ($i=0; $i<100; $i++) {
            $product= new Product;

            $product->name= $faker->words(2, true);
            $product->description= $faker->words(3, true);
            $product->type= $faker->randomElement(["COMPUTADOR", "MONITOR", "IMPRESSORA", "NOBREAK", "PERIFÉRICOS", "CELULAR", "OUTROS"]);
            $product->category= $faker->randomElement(["DESKTOP", "NOTEBOOK", "MONITOR", "LASER", "JATO DE TINTA", "SEM FIO", "COM FIO", "OUTROS"]);
            $product->manufacturer= $faker->randomElement(["LG", "DELL", "LENOVO", "HP"]);
            //$product->brand= $faker->randomElement(["LG", "DELL", "LENOVO", "HP"]);
            $product->model= $faker->word;
            $product->sn= $faker->randomNumber(8, false);
            $product->property_id= $faker->numberBetween(1000, 9999);

            $product->save();
        }
        echo "</pre>";
    }

    public function getInfo() {
        $product= Product::find(10);

        return json_encode($product);
    }
}
