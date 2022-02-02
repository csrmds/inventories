<?php

namespace App\Http\Controllers;

use App\Models\OcsServer;
use Illuminate\Support\Facades\DB;
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
        $this->ocsServer->database_password= $properties['database_password'];
        $this->ocsServer->database_port= $properties['database_port'];
        $this->ocsServer->status= $properties['status'];
    }

    public function create (Request $request)
    {
        $ocsServer= $request->input('ocsServer');
        //dd($this->ocsServer);

        $this->setProperties($ocsServer);
        

        try {
            $this->ocsServer->save();
            return json_encode($this->ocsServer);
        } catch(\Exception $e) {
            return reponse(json_encode($e->getMessage()), 418);
        }
    }

    public function update (Request $request)
    {
        $id= $request->input('id');
        $this->ocsServer= OcsServer::find($id);

        $this->ocsServer->alias= $ocsServer['alias'];
        $this->ocsServer->host= $ocsServer['host'];
        $this->ocsServer->database_name= $ocsServer['database_name'];
        $this->ocsServer->database_user= $ocsServer['database_user'];
        $this->ocsServer->database_password= $ocsServer['database_password'];
        $this->ocsServer->database_port= $ocsServer['database_port'];
        $this->ocsServer->status= $ocsServer['status'];

        try {
            $this->ocsServer->save();
            return json_encode($this->ocsServer);
        } catch(\Exception $e) {
            return reponse(json_encode($e->getMessage()), 418);
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
