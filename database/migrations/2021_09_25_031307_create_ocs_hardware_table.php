<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOcsHardwareTable extends Migration
{
	 /**
	  * Run the migrations.
	  *
	  * @return void
	  */
	 public function up()
	 {
			DB::statement(
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
				connection='mysql://ocs:ocs@192.168.18.25:3306/ocsweb_zurich/hardware'"
			);
	 }

	 /**
	  * Reverse the migrations.
	  *
	  * @return void
	  */
	 public function down()
	 {
		  Schema::dropIfExists('ocs_hardware');
	 }
}
