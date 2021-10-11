<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Product;
use Faker\Factory;


class ProductController extends Controller
{
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

        return view('product.create');
    }

    public function edit()
    {
        //$registers= Product::all();

		return view('product.index'); 
    }

    public function update()
    {
        //$registers= Product::all();

		return view('product.index'); 
    }

    public function destroy()
    {
        //$registers= Product::all();

		return view('product.index'); 
    }

    public function search(Request $request)
    {
        $data= $request->all();

        $products= DB::table('products')->where('name', 'like', $data['word'].'%')->get();

        return json_encode($products);

    }

    public function faker() 
    {
        
        $faker= Factory::create('pt_BR');
        //$faker::create('pt_BR');

        echo "<pre>";
        for ($i=0; $i<10; $i++) {
            $product= new Product;

            $product->name= $faker->words(2, true);
            $product->description= $faker->words(3, true);
            $product->type= $faker->randomElement(["Desktop", "Notebook", "Monitor", "Nobreak", "Impressora"]);
            $product->category= $faker->randomElement(["Computador", "Periférico", "Monitor"]);
            $product->manufacturer= $faker->randomElement(["LG", "DELL", "LENOVO", "HP"]);
            //$product->brand= $faker->randomElement(["LG", "DELL", "LENOVO", "HP"]);
            $product->model= $faker->word;
            $product->sn= $faker->randomNumber(8, false);
            $product->property_id= $faker->numberBetween(1000, 9999);

            //$product->save();
        }
        echo "</pre>";
    }

    public function getInfo() {
        $product= Product::find(10);

        return json_encode($product);
    }
}
