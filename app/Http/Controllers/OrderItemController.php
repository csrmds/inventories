<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
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

    public function getByOrder(Request $request) {
        $orderId= $request->input('order_id');
        $orderItems= DB::table('order_items')->where('order_id', $orderId)->get();

        return json_encode($orderItems);
    }

    public function save(Request $request) {
        $orderItem= $request->input('order_item');

        dd($orderItem);
        // $orderId= $request->input('order_id');
        // $productId= $request->input('product_id');
        //$orderItem= $request->input('order_item');

        //dd($request->all());

        if (DB::table('orders')->where('id', $orderItem['order_id'])->exists() && 
            DB::table('products')->where('id', $orderItem['product_id'])) {
            
            $this->setProperties($orderItem);
            try {
                $this->orderItem->save();
                return json_encode($this->orderItem);
            } catch(\Exception $e) {
                return json_encode($e->getMessage());
            }
            
        } else {
            return "O pedido ou produto não existe no banco de dados";
        }
    }

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
