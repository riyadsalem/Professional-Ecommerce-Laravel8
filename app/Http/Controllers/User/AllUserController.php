<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Session;
use Auth;
use Carbon\Carbon;
use App\Mail\OrderMail;
use PDF;

class AllUserController extends Controller
{
    
    public function MyOrders(){

        $orders = Order::where('user_id',Auth::id())->orderBy('id','DESC')->get();
        return view('frontend.user.order.order_view',compact('orders'));

    } // End Method



    public function OrderDetails($order_id){

        $order = Order::with('division','district','state','user')->where([ ['id',$order_id] , ['user_id',Auth::id()] ])->first();
        $orderItem = OrderItem::with('product')->where('order_id',$order_id)->orderBy('id','DESC')->get();
        return view('frontend.user.order.order_details',compact('order','orderItem'));

    } // End Method


    public function InvoiceDownload($order_id){

        $order = Order::with('division','district','state','user')->where([ ['id',$order_id] , ['user_id',Auth::id()] ])->first();
        $orderItem = OrderItem::with('product')->where('order_id',$order_id)->orderBy('id','DESC')->get();
       // return view('frontend.user.order.order_invoice',compact('order','orderItem'));

       $pdf = PDF::loadView('frontend.user.order.order_invoice',compact('order','orderItem'))->setPaper('a4')->setOptions([
        'tempDir' => public_path(),
        'chroot' => public_path(),
       ]);
       //dd($pdf);
       return $pdf->download('invoice.pdf');
   


    } // End FUNCTiON



    public function ReturnOrder(Request $request, $order_id){

        Order::findOrFail($order_id)->update([
            'return_date' => Carbon::now()->format('d F Y'),
            'return_reason' => $request->return_reason,
            'return_order' => 1,
        ]);

        $notification = array(
            'message' => 'Return Request Sent Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('my.orders')->with($notification);  

    } // End METHOD


    public function ReturnOrderList(){

        $orders = Order::where([ ['user_id',Auth::id()] , ['return_reason','!=',NULL] ])->orderBy('id','DESC')->get();
        return view('frontend.user.order.return_order_view',compact('orders'));


    } // End Method


    
    public function CancelOrders(){

        $orders = Order::where([ ['user_id',Auth::id()] , ['status','cancel'] ])->orderBy('id','DESC')->get();
        return view('frontend.user.order.cancel_order_view',compact('orders'));


    } // End Method


    // Order Tracking 
    public function OrderTracking(Request $request){

        $invoice = $request->code;
        $track = Order::where('invoice_no',$invoice)->first();
        
        if($track){

         /*   echo "<pre>";
            print_r($track);
            echo "</pre>";  */

            return view('frontend.tracking.track_order',compact('track'));

        }else{

            $notification = array(
                'message' => 'Invoice Code Is Invalid',
                'alert-type' => 'error'
            );
    
            return redirect()->back()->with($notification);  

        }

    } // End Method


}
