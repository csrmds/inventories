<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OcsServerController extends Controller
{
    private $ocsServer;

    public function __contruct() {
        $this->ocsServer= new OcsServer;
    }

    public function create (Request $request)
    {
        $ocsServer= $request->all();

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
