<?php

namespace App\Http\Controllers;

use App\Models\OcsServer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class OcsServerController extends Controller
{
    private $ocsServer;

    public function __construct() {
        $this->ocsServer= new OcsServer;
    }

    protected function setProperties($properties) {
        $this->ocsServer->alias= $properties['alias'];
        $this->ocsServer->host= $properties['host'];
        $this->ocsServer->database_name= $properties['database_name'];
        $this->ocsServer->database_user= $properties['database_user'];
        //$this->ocsServer->database_password= Hash::make($properties['database_password']);
        $this->ocsServer->database_password= $properties['database_password'];
        $this->ocsServer->database_port= $properties['database_port'];
        $this->ocsServer->status= $properties['status'];
    }

    public function create (Request $request)
    {
        $ocsServer= $request->input('ocsServer');
        $this->setProperties($ocsServer);

        try {
            $this->ocsServer->save();
            $this->ocsServer->success= true;
            return json_encode($this->ocsServer);
        } catch(\Exception $e) {
            return response(json_encode($e->getMessage()), 418);
        }
    }

    public function update (Request $request)
    {
        
        $ocsServer= $request->input('ocsServer');
        
        $this->ocsServer= OcsServer::find($ocsServer['id']);
        $this->setProperties($ocsServer);
        //dd($this->ocsServer);

        try {
            $this->ocsServer->save();
            $this->ocsServer->success= true;
            return json_encode($this->ocsServer);
        } catch(\Exception $e) {
            return response(json_encode($e->getMessage()), 418);
        }
    }

    public function destroy (Request $request)
    {

    }

    public function getById(Request $request)
    {
        $id= $request->input('id');
        $this->ocsServer= OcsServer::find($id);

        return json_encode($this->ocsServer);
    }

    public function search(Request $request)
    {

    }
}
