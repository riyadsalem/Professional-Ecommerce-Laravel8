
@extends('frontend.main_master')
@section('content')


<div class="body-content">
    <div class="container">
        <div class="row">

        
        @include('frontend.common.user_sidebar')

        <div class="col-md-1"></div>
        <div class="col-md-8" style="margin-top:30px;">

        <div class="table-responsive">
            <table class="table"> 

                    <tr style="background:#e2e2e2" >

                        <td class="col-md-1">
                            <label for="">Date</label>
                        </td>

                        <td class="col-md-3">
                            <label for="">Total</label>
                        </td>

                        <td class="col-md-3">
                            <label for="">Payment</label>
                        </td>

                        <td class="col-md-2">
                            <label for="">Invoice</label>
                        </td>
                        
                        <td class="col-md-2">
                            <label for="">Order Reason</label>
                        </td>

                        <td class="col-md-2">
                            <label for="">Order Status</label>
                        </td>

                        <td class="col-md-2">
                            <label for="">Action</label>
                        </td>

                    </tr>

                        @foreach($orders as $order)
                         <tr>

                           <td class="col-md-1">
                               <label for="">{{ $order -> order_date }}</label>
                           </td>
                           
                           <td class="col-md-3">
                               <label for="">
                                   @if($order->payment_type == 'Stripe')
                                   ${{ $order -> amount / 100 }}
                                   @else
                                   ${{ $order -> amount }}
                                   @endif
                                </label>
                           </td>

                           <td class="col-md-3">
                            <label for="">{{ $order -> payment_type }}</label>
                           </td>

                           <td class="col-md-2">
                               <label for="">{{ $order -> invoice_no }}</label>
                           </td>

                           <td class="col-md-2">
                               <label for="">{{ Str::limit($order -> return_reason , 15) }}</label>
                           </td>
                           
                           
                           <td class="col-md-2">
                               <label for="">
                                   @if($order->return_order == 0)
                                    <span class="badge badge-pill badge-warning" style="background: #d9534f; padding:7px; margin-top:5px;">No Return Request</span>

                                   @elseif($order->return_order == 1)

                                   <span class="badge badge-pill badge-warning" style="background: #800000; padding:7px; ">Pending</span>

                                    <span class="badge badge-pill badge-warning" style="background: #d9534f; padding:7px; margin-top:5px;">Return Request </span>

                                   @elseif($order->return_order == 2)
                                   <span class="badge badge-pill badge-warning" style="background: #008000; padding:7px; ">Success</span>
                                   @endif

                                </label>
                           </td>

                           <td class="col-md-1">
                               <label for="">
                                   <a href="{{ url('user/order_details/'.$order->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i> View</a>
                                   <a target="_blank" href="{{ url('user/invoice_download/'.$order->id) }}" class="btn btn-sm btn-danger" style="margin-top:5px;" ><i class="fa fa-download" style="color:white;"></i> Invoice</a>

                               </label>
                           </td>
                           
                         </tr>
                        @endforeach





                    
                </tbody>
            </table>
        </div>

        </div> <!-- col-md-8: End -->



        







        </div><!-- End row -->
    </div><!-- End container -->
</div> <!-- End body-content -->




@endsection
