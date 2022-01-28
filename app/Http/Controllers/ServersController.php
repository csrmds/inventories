<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServersController extends Controller
{
    public function ocsDropTables(Request $request) 
    {
        DB::statement(
            "drop table ocs_account_infos;
            drop table ocs_monitors;
            drop table ocs_hardware;"
        );
    }

    public function ocsCreateTables(Request $request)
    {
        
        $ocs_server= $request->input('ocs_server');
        $ocs_user= $request->input('ocs_user');
        $ocs_password= $request->input('ocs_password');
        $ocs_port= $request->input('ocs_port');

        $ocs_connection= 'mysql://'.$ocs_user.':'.$ocs_password.'@'.$ocs_server.':'.$ocs_port.'/ocsweb/hardware';

        DB::statement("drop table if exists ocs_hardware");
        DB::statement("drop table if exists ocs_monitors");
        DB::statement("drop table if exists ocs_account_infos");
        
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

    public function dcServer(Request $request) 
    {
        $host= $request->input('host');
        $domain= $request->input('domain');
        $userName= $request->input('user_name');
        $userPassword= $request->input('user_password');

        $domainDn= explode($domain, ".");



        // LDAP_HOST="192.168.18.38"
        // LDAP_BASE_DN="DC=csantos,DC=lab"
        // LDAP_USERNAME="CSANTOS\\administrator"
        // LDAP_PASSWORD="Seven@1010"
    }
}
