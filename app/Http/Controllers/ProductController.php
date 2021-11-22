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

    protected function setProperties($properties) {
        $this->product->name= $properties['name'];
        $this->product->reference= $properties['reference'];
        $this->product->description= $properties['description'];
        $this->product->type= $properties['type'];
        $this->product->category= $properties['category'];
        $this->product->manufacturer= $properties['manufacturer'];
        $this->product->brand= $properties['brand'];
        $this->product->model= $properties['model'];
        $this->product->sn= $properties['sn'];
        $this->product->tag= $properties['tag'];
        $this->product->property_id= $properties['property_id'];
        $this->product->size_id= $properties['size_id'];
        $this->product->color_id= $properties['color_id'];
        $this->product->um= $properties['um'];
        $this->product->status= $properties['status'];
        $this->product->obs= $properties['obs'];
        $this->product->ocs_hw_id= $properties['ocs_hw_id'];
        $this->product->ocs_mon_id= $properties['ocs_mon_id'];
        $this->product->people_id= $properties['people_id'];
        $this->product->location_id= $properties['location_id'];
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
        $category= DB::table('groups')->where('table', 'product_category')->get();
        $location= DB::table('locations')->get();

        return view('product.create', compact('type','um', 'category', 'location'));
    }

    public function save(Request $request)
    {
        // $data= $request->all();
        // dd($data);
        $this->setProperties($request->input('product'));

        try {
            $this->product->save();
            return json_encode($this->product);
        } catch (\Exception $e) {
            return json_encode($e->getMessate(), 418);
        }
    }

    public function update(Request $request)
    {
        $data= $request->input('product');
        $this->product= Product::Find($data['id']);
        $this->setProperties($data);
        
        try {
            $this->product->save();
            return response(json_encode($this->product));
        }catch(\Exception $e) {
            return response(json_encode($e->getMessage()), 418);
        }
        
    }

    public function destroy()
    {
		return view('product.index'); 
    }

    public function search(Request $request)
    {
        $data= $request->input('word');
        $products= DB::table('products')
            ->join('locations', 'products.location_id', '=', 'locations.id')
            ->select('products.*', 'locations.name as location_name')
            ->where('products.name', 'like', $data.'%')
            ->orWhere('products.property_id', 'like', $data.'%')
            ->paginate(10);
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

    public function getbyid(Request $request)
    {
        $id= $request->input('id');
        $this->product= Product::Find($id);
        $location= $this->product->location()->get();
        $this->product->location= $location[0]['name'];
        
        return json_encode($this->product);
    }

    public function teste(Request $request)
    {
        $id= $request->input('id');
        $teste= Product::Find(6);
        $y= $teste->location()->get();

        echo "<pre>";
        print_r($y);
        echo "</pre>";
        
        //return json_encode($y);
    }

    public function getgroups()
    {
        $type= DB::table('groups')->where('table', 'product_type')->get();
        $um= DB::table('groups')->where('table', 'product_um')->get();
        $category= DB::table('groups')->where('table', 'product_category')->get();
        $location= DB::table('locations')->get();
        
        $groups= [
            'typeList'=> $type,
            'umList'=> $um,
            'categoryList'=> $category,
            'locationList'=> $location
        ];

        return json_encode($groups);
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
