<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Group;
use App\Models\People;
use App\Models\Location;
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

    public function importPeople(Request $request)
    {
        $data= $request->all();
        return json_encode($data);
    }

    public function importProducts(Request $request)
    {
        $list= [];

        $file= Reader::createFromPath('../storage/files/csv/products.csv', 'r');
        $file->setHeaderOffset(0);
        $file->setDelimiter(';');

        $filter= Statement::create()->offset(0);
        $records= $filter->process($file);

        foreach ($records as $record) {

            if (empty($record['NUMERO DE SERIE']) && isset($record['SERIE'])) {
                $sn= $record['SERIE'];
            } else {
                $sn= $record['NUMERO DE SERIE'];
            };

            if ($location= Location::where('name', $record['LOCALIZACAO'])->first()) {
                $locationId= $location->id;
            } else {
                $locationId= null;
            }

            $product= new Product;
            $product->name= $record['TIPO'];
            $product->description= null;
            $product->type= $record['TIPO'];
            $product->category= null;
            $product->manufacturer= $record['MARCA'];
            $product->brand= $record['MARCA'];
            $product->model= $record['MODELO'];
            $product->sn= $sn;
            $product->property_id= $record['PATRIMONIO'];
            $product->um= "PC";
            $product->status= "ATIVO";
            $product->location_id= $locationId; //criar função para buscar a localização por nome

            //$product->save();

            array_push($list, $product);
        }


        return json_encode($list);
    }

    public function importLocations(Request $request)
    {
        $file= Reader::createFromPath('../storage/files/csv/locations.csv', 'r');
        $file->setHeaderOffset(0);
        $file->setDelimiter(';');

        $filter= Statement::create()->offset(0);
        $records= $filter->process($file);

        // foreach ($records as $record) {

        //     $location= new Location;
        //     $location->name= $record['LOCALIZACAO'];
        //     $location->description= $record['LOCALIZACAO'];
        //     $location->people_id= "101";

        //     try {
        //         //$location->save();
        //     } catch(\Exception $e) {
        //         return response(json_encode($e->getMessage()), 418) ;
        //     }

        // }

        return json_encode($records);
        // echo "<pre>";
        //     foreach ($records as $record) {
        //         print_r($record)."<br/>";
        //     }
        // echo "</pre>";
    }
}
