<?php

namespace App\Http\Controllers;

use App\Events\sent;
use App\Http\Requests\statusRequest;
use App\Models\Order;
use App\Events\NewOrder;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Gate;
use App\Http\Resources\OrderCollection;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Http\Resources\MedcineCollection;

class OrderController extends Controller
{  /**
    * Place a new order.
    */
   public function placeOrder(StoreOrderRequest $request)
   {
    Gate::authorize('placeOrder',Order::class);
       $order = Order::create([
           'user_id' => auth()->user()->id,
       ]);
       foreach ($request->input('items') as $item) {
           OrderItem::create([
               'order_id' => $order->id,
               'medcine_id' => $item['medcine_id'],
               'qtn_requested' => $item['qtn'],
           ]);
       }
       //call the new order event for listner
       event(new NewOrder($order));
       return response()->json(['message' => 'Order placed successfully']);
   }

   /**
    * View orders for the authenticated pharmacy user.
    */
   public function index()
   {
       return new OrderCollection(Order::where('user_id', auth()->user()->id)->get());
   }

   /**
    * View all orders from the warehouse perspective.
    */
   public function viewAllOrders()
   {
       return new OrderCollection(Order::all());
   }

   /**
    * Update the status of an order.
    */
   public function updateStatus($orderId,statusRequest $status)
   {
       $order = Order::findOrFail($orderId);
       if($status->status === 'sent'){
           event(new sent($order));
       }

       $order = Order::findOrFail($orderId);
       $order->status = $status->status;
       $order->save();

       return response()->json(['message' => 'Order status updated']);
   }

   /**
    * Update the billing status of an order.
    */
   public function updateBillingStatus($orderId, $billingstatus)
   {

       $order = Order::findOrFail($orderId);
       $order->billingstatus = $billingstatus;
       $order->save();

       return response()->json(['message' => 'Payment status updated']);
   }
//    public function __construct()
//    {
//        $this->authorizeResource(Order::class, 'orders');
//    }
}
