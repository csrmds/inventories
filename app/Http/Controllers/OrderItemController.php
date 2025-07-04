<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Movement;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class OrderItemController extends Controller
{
    private $orderItem;

    public function __construct() {
        $this->orderItem= new OrderItem;
    }

    protected function setProperties($properties) {
        $this->orderItem->order_id= $properties['order_id'];
        $this->orderItem->product_id= $properties['product_id'];
        $this->orderItem->description= $properties['description'];
        $this->orderItem->order= $properties['order'];
        $this->orderItem->amount= $properties['amount'];
        $this->orderItem->value= $properties['value'];
        $this->orderItem->discount= $properties['discount'];
        $this->orderItem->category= $properties['category'];
    }

    public function index() {
        $locations= DB::table('locations')->get();

        return view('orderItem.index', compact('locations'));
    }

    public function search(Request $request) {
        $data= $request->input('word');
        //DB::enableQueryLog();

        $orderItems= DB::table('order_items')
            ->leftJoin('orders', 'order_items.order_id', '=', 'orders.id')
            ->leftJoin('products', 'order_items.product_id', '=', 'products.id')
            ->leftJoin('people', 'products.people_id', '=', 'people.id')
            ->leftJoin('locations', 'products.location_id', '=', 'locations.id')
            ->leftJoin('ocs_hardware', 'products.ocs_hw_id', '=', 'ocs_hardware.id')
            ->select('order_items.*',
                'ocs_hardware.*',
                'products.name as product_name',
                'products.reference as product_reference',
                'products.description as product_description',
                'products.type as product_type',
                'products.category as product_category',
                'products.manufacturer as product_manufacturer',
                'products.brand as product_brand',
                'products.model as product_model',
                'products.sn as product_sn',
                'products.tag as product_tag',
                'products.property_id as product_property_id',
                'products.um as product_um',
                'products.status as product_status',
                'products.ocs_hw_id as product_ocs_hw_id',
                'products.ocs_mon_id as product_ocs_mon_id',
                'products.people_id as product_people_id',
                'products.location_id as product_location_id',
                'people.first_name as people_first_name',
                'people.last_name as people_last_name',
                'locations.name as location_name')
            ->where('products.property_id', 'like', $data.'%')
            ->orWhere('products.name', 'like', $data.'%')
            ->orWhere('products.manufacturer', 'like', $data.'%')
            ->orWhere('products.type', 'like', $data.'%')
            ->orWhere('products.model', 'like', $data.'%')
            ->orWhere('people.first_name', 'like', $data.'%')
            ->orWhere('people.last_name', 'like', $data.'%')
            ->orWhere('locations.name', 'like', $data.'%')
            ->paginate(10);

            //$resp= DB::getQueryLog();

        return json_encode($orderItems);
    }

    public function getByOrder(Request $request) {
        $orderId= $request->input('order_id');

        //DB::enableQueryLog();

        $orderItems= DB::table('order_items')
            ->leftJoin('products', 'order_items.product_id', '=', 'products.id')
            ->leftJoin('people', 'products.people_id', '=', 'people.id')
            ->leftJoin('locations', 'products.location_id', '=', 'locations.id')
            ->select('order_items.*',
                'products.name as product_name',
                'products.reference as product_reference',
                'products.description as product_description',
                'products.type as product_type',
                'products.category as product_category',
                'products.manufacturer as product_manufacturer',
                'products.brand as product_brand',
                'products.model as product_model',
                'products.sn as product_sn',
                'products.tag as product_tag',
                'products.property_id as product_property_id',
                'products.um as product_um',
                'products.status as product_status',
                'products.ocs_hw_id as product_ocs_hw_id',
                'products.ocs_mon_id as product_ocs_mon_id',
                'products.people_id as product_people_id',
                'products.location_id as product_location_id',
                'people.first_name as people_first_name',
                'people.last_name as people_last_name',
                'locations.name as location_name')
            ->where('order_id', $orderId)->get();

            //dd(DB::getQueryLog());

        return json_encode($orderItems);
    }

    public function save(Request $request) 
    {
        $orderItems= $request->input('order_items');
        $order= $request->input('order');

        if (DB::table('orders')->where('id', $orderItem['order_id'])->exists() && 
            DB::table('products')->where('id', $orderItem['product_id'])) {

            if (DB::table('order_items')->where('order_id', $orderItem['order_id'])->exists()) {
                $order= DB::table('order_items')->max('order')->where('order_id', $orderItem['order_id']);
                $orderItem['order']= $order++;
            } else {
                $orderItem['order']= 1;
            }
            
            $this->setProperties($orderItem);
            $product= Product::Find($orderItem['product_id']);
            $product->people_id= $order['people_destiny'];
            $product->location_id= $order['location_destiny'];
            //dd($order);
            $order= Order::Find($order['id']);
            
            foreach ($orderItems as $orderItem) {

                $this->orderItem= new OrderItem;
                $this->setProperties($orderItem);
                $this->orderItem->order_id= $order->id;

                $movement= new Movement;
                $movement->order_id= $order->id;
                $movement->product_id= $this->orderItem->product_id;
                $movement->amount= $this->orderItem->amount!=null ? $this->orderItem->amount : 1;
                $movement->order_item_order= $this->orderItem->order;
                $movement->movement= $order->category;

                try {
                    $this->orderItem->save();

                    try {
                        $movement->save();

                        $product= Product::Find($this->orderItem->product_id);
                        $product->location_id= $order->location_destiny;
                        $product->people_id= $order->people_destiny;

                        try {
                            $product->save();
                        } catch (\Exception $e) {
                            return response(json_encode($e->getMessage()), 418);
                        }

                    } catch (\Exception $e) {
                        return response(json_encode($e->getMessage()), 418);
                    }

                } catch(\Exception $e) {
                    return response(json_encode($e->getMessage()), 418);
                }

            }

            $order->status= "CONCLUIDO";
            $order->save();
            return json_encode([$order, $orderItems, $product]);

            
        } else {
            return "O pedido ou produto não existe no banco de dados";
        }
    }

    // public function saveOld(Request $request) {
    //     $orderItem= $request->input('order_item');
    //     $order= $request->input('order');

    //     if (DB::table('orders')->where('id', $orderItem['order_id'])->exists() && 
    //         DB::table('products')->where('id', $orderItem['product_id'])) {

    //         if (DB::table('order_items')->where('order_id', $orderItem['order_id'])->exists()) {
    //             $order= DB::table('order_items')->max('order')->where('order_id', $orderItem['order_id']);
    //             $orderItem['order']= $order++;
    //         } else {
    //             $orderItem['order']= 1;
    //         }
            
    //         $this->setProperties($orderItem);
    //         $product= Product::Find($orderItem['product_id']);
    //         $product->people_id= $order['people_destiny'];
    //         $product->location_id= $order['location_destiny'];
    //         $order= Order::Find($order['id']);
            
    //         $movement= new Movement;
    //         $movement->order_id= $orderItem['order_id'];
    //         $movement->product_id= $orderItem['product_id'];
    //         $movement->amount= $orderItem['amount']!=null ? $item['amount'] : 1;
    //         $movement->order_item_order= $orderItem['order'];
    //         $movement->movement= $order->category;
            
    //         try {
    //             $this->orderItem->save();
                
    //             try {
    //                 $product->save();

    //                 try {
    //                     $movement->save();
    //                     $order->status= "CONCLUIDO";

    //                     try {
    //                         $order->save();
    //                     } catch(\Exception $e) {
    //                         return json_encode($e->getMessage());
    //                     }

    //                 } catch(\Exception $e) {
    //                     return json_encode($e->getMessage());
    //                 }

    //             } catch(\Exception $e) {
    //                 return json_encode($e->getMessage());
    //             }

    //             //return redirect()->action([MovementController::class, 'saveByOrder'], ['order_id'=>$order->id]);
                
    //             return json_encode([$order, $orderItem, $movement]);
    //         } catch(\Exception $e) {
    //             return json_encode($e->getMessage());
    //         }
            
    //     } else {
    //         return "O pedido ou produto não existe no banco de dados";
    //     }
    // }

    public function destroy(Request $request) {
        $orderId= $request->input('order_id');
        $orderItem= $request->input('order_item');

        $query= DB::table('orderItems')
            ->where('order_id', $orderId)
            ->where('order', $orderItem)
            ->delete();
        
        return json_encode($query);
    }

    public function update(Request $request) {

    }
}
