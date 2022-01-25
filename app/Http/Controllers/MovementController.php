<?php

namespace App\Http\Controllers;

use App\Models\Movement;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MovementController extends Controller
{
    private $movement;

    public function __construct() {
        $this->movement= new Movement;
    }

    protected function setProperties($properties) {
        $this->movement->product_id= $properties['product_id'];
        $this->movement->order_id= $properties['order_id'];
        $this->movement->order_item_order= $properties['order_item_id'];
        $this->movement->amount= $properties['amount'];
        $this->movement->movement= $properties['movement'];
        $this->movement->order_reference_id= $properties['order_reference_id'];
    }

    public function save(Request $request) {
        $movement= $request->input('movement');

        $this->setProperties($movement);
        try {
            $this->movement->save();
            return json_encode($this->movement);
        } catch(\Exception $e) {
            return response(json_encode($e->getMessage()), 418);
        }
    }

    public function saveByOrder(Request $request) {
        $orderId= $request->input('order_id');
        $order= Order::Find($orderId);
        $orderItems= DB::table('order_items')->where('order_id', $orderId)->get();
        
        $orderItems= json_decode(json_encode($orderItems), true); //converter em array

        foreach($orderItems as $item) {

            //dd($item);
            //print_r($item);

            $movement= new Movement;
            $movement->order_id= $orderId;
            $movement->product_id= $item['product_id'];
            $movement->amount= $item['amount']!=null ? $item['amount'] : 1;
            $movement->order_item_order= $item['order'];
            $movement->movement= $order->category;

            //dd($movement);
            try {
                $movement->save();
            } catch(\Exception $e) {
                return response(json_encode($e->getMessage()), 418) ;
            }
        }

        $array=[$order, $orderItems, $movement];

        return json_encode($array);

    }

    public function update(Request $request) {

    }

    public function getById(Request $request) {
        $id= $request->input('id');

        $movement= DB::table('movements')
            ->leftJoin('products', 'movements.product_id', 'products.id')
            ->leftJoin('orders', 'movements.order_id', 'orders.id')
            ->leftJoin('people as people_origin', 'orders.people_origin', 'people.id')
            ->leftJoin('people as people_destiny', 'orders.people_destiny', 'people.id')
            ->select('orders.*',
                'people_origin.first_name as people_origin_first_name',
                'people_origin.last_name as people_origin_last_name',
                'people_destiny.first_name as people_destiny_last_name',
                'people_destiny.last_name as people_destiny_last_name',
                'products.name as product_name',
                'products.description as product_description',
                'products.type as product_type',
                'products.cateogry as product_category',
                'products.manufacturer as product_manufacturer',
                'products.brand as product_brand',
                'products.model as product_model',
                'products.sn as product_sn',
                'products.property_id as product_property_id')
            ->where('movements.id', $id)->get();

            return json_encode($movement);

    }

    public function search(Request $request) {

    }


}
