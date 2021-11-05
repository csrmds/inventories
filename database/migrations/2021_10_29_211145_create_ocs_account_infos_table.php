<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOcsAccountInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement(
            "create table ocs_account_infos(
                hardware_id int(11) not null,
                tag varchar(255),
                primary key(hardware_id),
                key tag (tag) )
            engine=federated
            default charset=utf8
            connection='mysql://ocs:ocs@192.168.18.25:3306/ocsweb_zurich/accountinfo'"
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ocs_account_infos');
    }
}
