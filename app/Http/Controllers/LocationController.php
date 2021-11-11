<?php

namespace App\Http\Controllers;

use App\models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Group;


class LocationController extends Controller
{
    private $location;

    public function __construct() {
        $this->location= new Location;
    }

    public function index() {
        $this->location= Location::all();

        return view('location.index', ['location'=> $this->location]);
    }
}
