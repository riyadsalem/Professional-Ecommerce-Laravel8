<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Session;
use Auth;
use Carbon\Carbon;
use PDF;
use App\Models\Product;
use DB;


class OrderController extends Controller
{
    
    // Pending OrderS
    public function PendingOrders(){

        $orders = Order::where('status','Pending')->orderBy('id','DESC')->get();
        return view('backend.orders.pending_orders',compact('orders'));

    } // End Method


    public function PendingOrdersDetails($order_id){

        $order = Order::with('division','district','state','user')->where('id',$order_id)->first();
        $orderItem = OrderItem::with('product')->where('order_id',$order_id)->orderBy('id','DESC')->get();
        return view('backend.orders.pending_orders_details',compact('order','orderItem'));

    } // En FuNcTiOn



        // Confirmed OrderS
        public function ConfirmedOrders(){

            $orders = Order::where('status','confirm')->orderBy('id','DESC')->get();
            return view('backend.orders.confirmed_orders',compact('orders'));
    
        } // End Methods



        // Processing OrderS
        public function ProcessingOrders(){

            $orders = Order::where('status','processing')->orderBy('id','DESC')->get();
             return view('backend.orders.processing_orders',compact('orders'));
            
        } // End Methods


        // Picked OrderS
        public function PickedOrders(){

            $orders = Order::where('status','picked')->orderBy('id','DESC')->get();
            return view('backend.orders.picked_orders',compact('orders'));
                    
        } // End Method


    
        // Shipped OrderS
        public function ShippedOrders(){

            $orders = Order::where('status','shipped')->orderBy('id','DESC')->get();
            return view('backend.orders.shipped_orders',compact('orders'));
                           
         } // End Method
       


        // Delivered OrderS
        public function DeliveredOrders(){

            $orders = Order::where('status','delivered')->orderBy('id','DESC')->get();
            return view('backend.orders.delivered_orders',compact('orders'));
                    
        } // End Method



        // Cancel OrderS
         public function CancelOrders(){

             $orders = Order::where('status','cancel')->orderBy('id','DESC')->get();
            return view('backend.orders.cancel_orders',compact('orders'));
                        
          } // End Method




          // Update Pending Order To Confirm
          public function PendingToConfirm($order_id){

            Order::findOrFail($order_id)->update([
                'status' => 'confirm',
               // 'confirmed_date' => Carbon::now(),
            ]);

            $notification = array(
                'message' => 'Order Confirm Successfully',
                'alert-type' => 'success'
            );
    
            return redirect()->route('pending-orders')->with($notification);   
          } // End Method





         // Update Confirm Order To Processing
          public function ConfirmToProcessing($order_id){

            Order::findOrFail($order_id)->update([
                'status' => 'processing',
               // 'confirmed_date' => Carbon::now(),
            ]);

            $notification = array(
                'message' => 'Order Processing Successfully',
                'alert-type' => 'success'
            );
    
            return redirect()->route('confirmed-orders')->with($notification);   
          } // End Method





         // Update Processing Order To Picked
          public function ProcessingToPicked($order_id){

            Order::findOrFail($order_id)->update([
                'status' => 'picked',
               // 'confirmed_date' => Carbon::now(),
            ]);

            $notification = array(
                'message' => 'Order Picked Successfully',
                'alert-type' => 'success'
            );
    
            return redirect()->route('processing-orders')->with($notification);   
          } // End Method





         // Update Picked Order To Shipped
          public function PickedToShipped($order_id){

            Order::findOrFail($order_id)->update([
                'status' => 'shipped',
               // 'confirmed_date' => Carbon::now(),
            ]);

            $notification = array(
                'message' => 'Order Shipped Successfully',
                'alert-type' => 'success'
            );
    
            return redirect()->route('picked-orders')->with($notification);   
          } // End Method






         // Update Shipped Order To Delivered
         public function ShippedToDelivered($order_id){


            $product = OrderItem::where('order_id',$order_id)->get();
            foreach($product as $item){
                Product::where('id',$item->product_id)->update([
                    'product_qty' => DB::raw('product_qty -'.$item->qty)
                ]);
            }



            Order::findOrFail($order_id)->update([
                'status' => 'delivered',
               // 'confirmed_date' => Carbon::now(),
            ]);

            $notification = array(
                'message' => 'Order Delivered Successfully',
                'alert-type' => 'success'
            );
    
            return redirect()->route('shipped-orders')->with($notification);   
          } // End Method






         // Update Delivered Order To Cancel
         public function DeliveredToCancel($order_id){

            Order::findOrFail($order_id)->update([
                'status' => 'cancel',
               // 'confirmed_date' => Carbon::now(),
            ]);

            $notification = array(
                'message' => 'Order Cancel Successfully',
                'alert-type' => 'success'
            );
    
            return redirect()->route('delivered-orders')->with($notification);   
          } // End Method


          public function AdminInvoiceDownload($order_id){

            $order = Order::with('division','district','state','user')->where('id',$order_id)->first();
            $orderItem = OrderItem::with('product')->where('order_id',$order_id)->orderBy('id','DESC')->get();
           
           $pdf = PDF::loadView('backend.orders.order_invoice',compact('order','orderItem'))->setPaper('a4')->setOptions([
            'tempDir' => public_path(),
            'chroot' => public_path(),
           ]);
           return $pdf->download('invoice.pdf');


          } // End Method






}
