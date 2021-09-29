<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OcsHardware extends Model
{
	use HasFactory;

	protected $fillable=[
		'id',
		'deviceid',
		'name',
		'workgroup',
		'userdomain',
		'osname',
		'osversion',
		'oscomments',
		'processort',
		'processors',
		'processorn',
		'memory',
		'swap',
		'ipaddr',
		'dns',
		'defaultgateway',
		'etime',
		'lastdate',
		'lastcome',
		'quality',
		'fidelity',
		'userid',
		'type',
		'description',
		'wincompany',
		'winowner',
		'winprodid',
		'winprodkey',
		'useragent',
		'checksum',
		'sstate',
		'ipsrc',
		'uuid',
		'arch',
		'category_id',
		'archive'
	];
}
