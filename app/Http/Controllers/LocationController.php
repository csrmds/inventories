<?php

namespace App\Http\Controllers;

use App\models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Group;


class LocationController extends Controller
{
    private $location;

    public function __construct() {
        $this->location= new Location;
    }

    public function index() {
        $this->location= Location::all();

        return view('location.index', ['location'=> $this->location]);
    }

    protected function setProperties($properties) {
        $this->location->people_id= $properties['people_id'];
        $this->location->name= $properties['name'];
        $this->location->description= $properties['description'];
    }

    public function save(Request $request)
    {
        $this->setProperties($request->input('location'));
        // $data= $request->input('location');
        // dd($data);

        try {
            $this->location->save();
            return response(json_encode($this->location));
        } catch(\Exception $e) {
            return response(json_encode($e->getMessage()), 418);
        }
    }

    public function update(Request $request)
    {
        $location= $request->input('location');
        $this->location= Location::Find($location['id']);
        $this->setProperties($location);

        try {
            $this->location->save();
            return response(json_encode($this->location));
        } catch(\Exception $e) {
            return response(json_encode($e->getMessage()), 418);
        }
    }

    public function destroy(Request $request)
    {
        $id= $request->input('id');

        try {
            Location::destroy($id);
            return response(json_encode(["msg"=> "Registro deletado com sucesso"]));
        } catch(\Exception $e) {
            return response(json_encode($e->getMessage()), 418);
        }
    }

    public function search(Request $request)
    {
        $data= $request->input('word');
        $location= DB::table('locations')
            ->where('name', 'like', $data['word'].'%')
            ->orWhere('description', 'like', $data['word'].'%')->get();
        return json_encode($location);
    }

    public function getById(Request $request)
    {
        $id= $request->input('id');
        $location= DB::table('locations')->where('id', $id)->get();

        return json_encode($location);
    }
}
