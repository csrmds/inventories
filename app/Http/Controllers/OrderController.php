<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\People;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    private $order;

    public function __construct() {
        $this->order= new Order;
    }

    protected function setProperties($properties) {
        $this->order->people_origin= $properties['people_origin'];
        $this->order->people_destiny= $properties['people_destiny'];
        $this->order->title= $properties['title'];
        $this->order->category= $properties['category'];
        $this->order->description= $properties['description'];
        $this->order->location_origin= $properties['location_origin'];
        $this->order->location_destiny= $properties['location_destiny'];
        $this->order->user_id= $properties['user_id'];
        $this->order->request_from= $properties['request_from'];
        $this->order->value= $properties['value'];
        $this->order->discount= $properties['discount'];
        $this->order->status= $properties['status'];
    }

    public function index() {
        $orders= $this->location= Order::all();
        $locations= DB::table('locations')->get();

        return view('order.index', compact('orders', 'locations'));
    }

    public function search(Request $request) {
        //busca por nome de pessoas ou locais
    }

    public function getById(Request $request) {
        $id= $request->input('id');
        $order= DB::table('orders')->where('id', $id)->get();

        return json_encode($order);
    }

    public function save(Request $request) {
        //dd($request->all());
        $this->setProperties($request->input('order'));

        if ($this->order->location_origin==null) {
            $this->order->location_origin= 1 ;
        }

        if ($this->order->people_origin==null) {
            $this->order->people_origin= 101;
        }
        
        $userSession= session()->get('userLogin');
        $this->order->user_id= $userSession['id'];

        try {
            $this->order->save();
            return json_encode($this->order);
        } catch(\Exception $e) {
            return response(json_encode($e->getMessage()), 418);
        }
    }

    public function update(Request $request) {
        $oder= $request->input('order');
        $this->order= Order::Find($order['id']);
        $this->setProperties($order);

        try {
            $this->order->save();
            return json_encode($this->order);
        } catch(\Exception $e) {
            return response(json_encode($e->getMessage()), 418);
        }
    }

    public function getLastOrderItem($orderId) {
        if (DB::table('order_item')->where('order_id', $orderId)->exists()) {
            $order= DB::table('order_item')->max('order')->where('order_id', $orderId);
            return $order++;
        } else {
            return 1;
        }
    }
}
