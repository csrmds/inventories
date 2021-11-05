<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\OcsHardware;
use App\Models\OcsAccountInfo;

class OcsHardwareController extends Controller
{
    private $ocsHardware;

    // public function __construnct() {
    //     $this->ocsHardware= new OcsHardware;
    // }

    public function search(Request $request)
    {
        $data= $request->all();

        $result= DB::select("select * from ocs_hardware 
            left join ocs_account_infos on ocs_hardware.id=ocs_account_infos.hardware_id 
            where ocs_hardware.name like '{$data['word']}%' or
                ocs_hardware.ipaddr like '{$data['word']}%' or
                ocs_hardware.userid like '{$data['word']}%' or
                ocs_account_infos.tag like '{$data['word']}%'");

        // $this->ocsHardware= OcsHardware::find(118);
        // $tag= $this->ocsHardware->tag()->get();

        //return json_encode($this->ocsHardware);
        return json_encode($result);

    }

    public function searchById(Request $request)
    {
        $data= $request->all();
        
        if ($this->ocsHardware= OcsHardware::Find($request->input('id'))) {
            $this->ocsHardware->tag= ($this->ocsHardware->tag()->get('tag'))[0]['tag'];
            return json_encode($this->ocsHardware);
        } else {
            $error= ["error"=> "Não foi encontrado nenhum registro"];
            return json_encode($error);
        }
       
        

        //dd($this->ocsHardware);
    }

}
