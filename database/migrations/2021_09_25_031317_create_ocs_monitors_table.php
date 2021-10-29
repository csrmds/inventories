<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOcsMonitorsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::statement(
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
			connection='mysql://ocs:ocs@192.168.18.25:3306/ocsweb_zurich/monitors'"
		);
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('ocs_monitors');
	}
}
