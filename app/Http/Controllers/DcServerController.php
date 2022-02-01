<?php

namespace App\Http\Controllers;

use App\Models\DcServer;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DcServerController extends Controller
{

    private $dcServer;

    public function __construct() {
        $this->dcServer= new DcServer;
    }

    public function create (Request $request)
    {
        $dcServer= $request->all();

        $this->dcServer->alias= $dcServer['alias'];
        $this->dcServer->host= $dcServer['host'];
        $this->dcServer->domain_name= $dcServer['domain_name'];
        $this->dcServer->user= $dcServer['user'];
        $this->dcServer->password= $dcServer['password'];
        $this->dcServer->port= $dcServer['port']!=null ? $dcServer['port'] : null;

        try {
            $this->dcServer->save();
            return json_encode($this->dcServer);
        } catch(\Exception $e) {
            return reponse(json_encode($e->getMessage()), 418);
        }


    }

    public function update (Request $request)
    {
        $id= $request->input('id');
        $this->dcServer= DcServer::find($id);

        $this->dcServer->alias= $dcServer['alias'];
        $this->dcServer->host= $dcServer['host'];
        $this->dcServer->domain_name= $dcServer['domain_name'];
        $this->dcServer->user= $dcServer['user'];
        $this->dcServer->password= $dcServer['password'];
        $this->dcServer->port= $dcServer['port']!=null ? $dcServer['port'] : null;

        try {
            $this->dcServer->save();
            return json_encode($this->dcServer);
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
        $this->dcServer= DcServer::find($id);

        return json_encode($this->dcServer);
    }

    public function search(Request $request)
    {
        
    }
}
