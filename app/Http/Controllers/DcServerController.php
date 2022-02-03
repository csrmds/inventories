<?php

namespace App\Http\Controllers;

use App\Models\DcServer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class DcServerController extends Controller
{

    private $dcServer;

    public function __construct() {
        $this->dcServer= new DcServer;
    }

    protected function setProperties($properties) {
        $this->dcServer->alias= $properties['alias'];
        $this->dcServer->host= $properties['host'];
        $this->dcServer->domain_name= $properties['domain_name'];
        $this->dcServer->user= $properties['user'];
        //$this->dcServer->password= Hash::make($properties['password']);
        $this->dcServer->password= $properties['password'];
        $this->dcServer->port= $properties['port']!=null ? $properties['port'] : null;
    }

    public function create (Request $request)
    {
        $dcServer= $request->input('dcServer');
        $this->setProperties($dcServer);
        
        try {
            $this->dcServer->save();
            $this->dcServer->success= true;
            return json_encode($this->dcServer);
        } catch(\Exception $e) {
            return response(json_encode($e->getMessage()), 418);
        }

    }

    public function update (Request $request)
    {
        $dcServer= $request->input('dcServer');
        $this->dcServer= DcServer::find($dcServer['id']);
        $this->setProperties($dcServer);

        try {
            $this->dcServer->save();
            $this->dcServer->success= true;
            return json_encode($this->dcServer);
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

        try {
            $this->dcServer= DcServer::find($id);
            //$this->dcServer->success= true;
            return json_encode($this->dcServer);
        } catch (\Exception $e) {
            return response(json_encode($e->getMessage()), 418);
        }
    
    }

    public function search(Request $request)
    {
        
    }
}
