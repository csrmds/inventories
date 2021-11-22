<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Group;
use App\Models\People;
use League\Csv\Reader;
use League\Csv\Writer;
use League\Csv\Statement;

class CsvController extends Controller
{
    public function index() 
    {
        $file= Reader::createFromPath('../storage/files/csv/inventorie_products.csv', 'r');
        $file->setHeaderOffset(0);
        $file->setDelimiter(';');

        $filter= Statement::create()->offset(0);
        $records= $filter->process($file);

        // foreach ($records as $record) {
        //     $product= new Product;

        //     $product->name= $record['TIPO'];
        //     $product->type= $record['TIPO'];
        //     $product->brand= $record['MARCA'];
        //     $product->model= $record['MODELO'];
        //     $product->sn= $record['NUMERO DE SÉRIE'];
        //     $product->property_id= $record['PATRIMONIO'];
        //     $product->status= $record['SITUAÇÃO'];
        //     $product->um= "PC";
        //     $product->location_id= $record['LOCALIZAÇÃO ID'];
        //     $product->obs= $record['OBS']."\nGarantia: ".$record['Garantia'];

        //     //$product->save();

        // }

        return view('csv.index', compact('records'));
    }

    public function importProducts(Request $request)
    {
        $data= $request->all();
        return json_encode($data);
    }

    public function importPeople(Request $request)
    {
        $data= $request->all();
        return json_encode($data);
    }
}
