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

    public function ocsDropTables(Request $request) 
    {
        DB::statement(
            "drop table ocs_account_infos;
            drop table ocs_monitors;
            drop table ocs_hardware;"
        );
    }

    public function recreateTables(Request $request)
    {
        
        $this->ocsServer= OcsServer::Find(1);

        if ($this->ocsServer==null) {
            return response(json_encode(["success"=> false, "msg"=> "Não foi encontrado nenhum registro"]), 418);
        }

        $user= $this->ocsServer->database_user;
        $password= $this->ocsServer->database_password;
        $server= $this->ocsServer->host;
        $port= $this->ocsServer->database_port;
        $database_name= $this->ocsServer->database_name;

        $ocs_connection= 'mysql://'.$user.':'.$password.'@'.$server.':'.$port.'/'.$database_name.'/hardware';

        DB::statement("drop table if exists ocs_account_infos");
        DB::statement("drop table if exists ocs_monitors");
        DB::statement("drop table if exists ocs_hardware");
        
        try {
            $queryOcsHardware= DB::statement(
                "CREATE TABLE ocs_hardware (
                    id int(11) not null auto_increment,
                    deviceid varchar(255) not null,
                    name varchar(255) default null,
                    workgroup varchar(255) default null,
                    userdomain varchar(255) default null,
                    osname varchar(255) default null,
                    osversion varchar(255) default null,
                    oscomments varchar(255) default null,
                    processort varchar(255) default null,
                    processors int(11) default 0,
                    processorn smallint(6) default null,
                    memory int(11) default null,
                    swap int(11) default null,
                    ipaddr varchar(255) default null,
                    dns varchar(255) default null,
                    defaultgateway varchar(255) default null,
                    etime datetime default null,
                    lastdate datetime default null,
                    lastcome datetime default null,
                    quality decimal(7,4) default null,
                    fidelity bigint(20) default 1,
                    userid varchar(255) default null,
                    type int(11) default null,
                    description varchar(255) default null,
                    wincompany varchar(255) default null,
                    winowner varchar(255) default null,
                    winprodid varchar(255) default null,
                    winprodkey varchar(255) default null,
                    useragent varchar(50) default null,
                    checksum bigint(20) unsigned default 262143,
                    sstate int(11) default 0,
                    ipsrc varchar(255) default null,
                    uuid varchar(255) default null,
                    arch varchar(10) default null,
                    category_id int(11) default null,
                    archive int(11) default null,
                    primary key (id),
                    key deviceid (deviceid),
                    key name (name),
                    key checksum (checksum),
                    key userid (userid),
                    key workgroup (workgroup),
                    key osname (osname),
                    key memory (memory) ) 
                ENGINE=federated
                default charset=utf8
                connection='$ocs_connection'"
            );

        } catch(\Exception $e) {
            return json_encode($e->getMessage());
        }

        $ocs_connection= 'mysql://'.$user.':'.$password.'@'.$server.':'.$port.'/'.$database_name.'/monitors';
        
        try {
            $queryOcsMonitors= DB::statement(
                "CREATE TABLE ocs_monitors (
                    ID int(11) not null AUTO_INCREMENT,
                    HARDWARE_ID int(11) not null,
                    MANUFACTURER varchar(255) default null,
                    CAPTION varchar(255) default null,
                    DESCRIPTION varchar(255) default null,
                    TYPE varchar(255) default null,
                    SERIAL varchar(255) default null,
                    PRIMARY KEY (ID),
                    KEY HARDWARE_ID (HARDWARE_ID) ) 
                ENGINE=federated 
                default CHARSET=utf8
                connection='$ocs_connection'"
            );

        } catch(\Exception $e) {
            return json_encode($e->getMessage());
        }
        
        $ocs_connection= 'mysql://'.$user.':'.$password.'@'.$server.':'.$port.'/'.$database_name.'/accountinfo';

        try {
            $queryOcsAccount= DB::statement(
                "create table ocs_account_infos(
                    hardware_id int(11) not null,
                    tag varchar(255),
                    primary key(hardware_id),
                    key tag (tag) )
                engine=federated
                default charset=utf8
                connection='$ocs_connection'"
            );
        } catch(\Exception $e) {
            return json_encode($e->getMessage());
        }

        return json_encode([$queryOcsHardware, $queryOcsMonitors, $queryOcsAccount]);

    }
}
