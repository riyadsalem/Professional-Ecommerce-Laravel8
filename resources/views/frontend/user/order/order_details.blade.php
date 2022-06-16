
@extends('frontend.main_master')
@section('content')


<div class="body-content">
    <div class="container">
        <div class="row">

        
        @include('frontend.common.user_sidebar')

        <div class="col-md-5"> <!-- col-md-5: Start 1FI  -->
            <div class="card">
                <div class="card-header"><h4>Shpping Details</h4></div><hr>
                <div class="card-body" style="background: #E9EBEC;">
                <table class="table">
                    <tr>
                        <th>Shipping Name : </th>
                        <th> {{ $order->name}} </th>
                    </tr>

                    <tr>
                        <th>Shipping Email : </th>
                        <th> {{ $order->email}} </th>
                    </tr>

                    <tr>
                        <th>Shipping Phone : </th>
                        <th> {{ $order->phone}} </th>
                    </tr>

                    <tr>
                        <th>Division : </th>
                        <th> {{ $order->division->division_name}} </th>
                    </tr>

                    <tr>
                        <th>District : </th>
                        <th> {{ $order->district->district_name}} </th>
                    </tr>

                    <tr>
                        <th>State : </th>
                        <th> {{ $order->state->state_name}} </th>
                    </tr>

                    <tr>
                        <th>Post Code : </th>
                        <th> {{ $order->post_code}} </th>
                    </tr>

                    <tr>
                        <th>Order Date : </th>
                        <th> {{ $order->order_date}} </th>
                    </tr>

                </table>
                </div>
            </div>
        </div> <!-- col-md-5: End 1FI -->


        
        <div class="col-md-5"> <!-- col-md-5: Start 2ND  -->
            <div class="card">
                <div class="card-header"><h4>Order Details</h4>
                <span class="text-danger">Invoice: {{ $order->invoice_no }}</span>
                </div><hr>
                <div class="card-body" style="background: #E9EBEC;">
                <table class="table">
                    <tr>
                        <th>User Name : </th>
                        <th> {{ $order->user->name}} </th>
                    </tr>

                    <tr>
                        <th>User Phone : </th>
                        <th> {{ $order->user->phone}} </th>
                    </tr>

                    <tr>
                        <th>Payment Type : </th>
                        <th> {{ $order->payment_type}} </th>
                    </tr>

                    <tr>
                    @if($order->payment_type == 'Stripe')
                      <th>Tranx ID : </th>
                      <th> {{ $order->transaction_id}} </th>
                    @else         
                    @endif
                    </tr>

                    <tr>
                        <th>Invoice : </th>
                        <th class="text-danger"> {{ $order->invoice_no}} </th>
                    </tr>

                    <tr>
                        <th>Order Total : </th>
                        <th>       
                            @if($order->payment_type == 'Stripe')
                            ${{ $order -> amount / 100 }}
                            @else
                            ${{ $order -> amount }}
                            @endif
                        </th>
                    </tr>

                    <tr>
                        <th>Order : </th>
                        <th><span class="badge badge-pill badge-warning" style="background: #418DB9; padding:7px;">{{ $order -> status }}</span>
                        </th>
                    </tr>

                </table>
                </div>
            </div>
        </div> <!-- col-md-5: End 2ND -->



  <div class="row"> <!-- row >> Order Item Row: Start  -->

    <div class="col-md-10" style="margin-top:30px;">

      <div class="table-responsive">
        <table class="table"> 

            <tr style="background:#e2e2e2" >

                <th >
                    <label for="">Image</label>
                </th>

                <th >
                    <label for="">Product Name</label>
                </th>

                <th >
                    <label for="">Product Code</label>
                </th>

                <th >
                    <label for="">Color</label>
                </th>
                
                <th >
                    <label for="">Size</label>
                </th>

                <th >
                    <label for="">Quantity</label>
                </th>

                <th >
                    <label for="">Price</label>
                </th>

                <th >
                    <label for="">Download</label>
                </th>

            </tr>

                @foreach($orderItem as $item)
                 <tr>

                   <td >
                       <label for=""><img src="{{ asset($item->product->product_thambnail) }}" alt="" height="50px" width="50px"></label>
                   </td>
                   
                   <td class="col-md-3">
                       <label for="">
                          @if(session()->get('language') == 'arabic')  
                          {{ $item -> product-> product_name_ar }}
                          @else
                          {{ $item -> product-> product_name_en }}
                          @endif
                    </label>
                   </td>

                   <td >
                    <label for="">{{ $item -> product -> product_code }}</label>
                   </td>

                   <td >
                       <label for="">
                         @if($item->color == '')
                           <span class="text-danger">Empty</span>
                           @else
                           {{ $item -> color }}
                         @endif
                       </label>
                   </td>

                   <td >
                       <label for="">
                           @if($item->size == '')
                           <span class="text-danger">Empty</span>
                           @else
                           {{ $item -> size }}
                           @endif
                        </label>
                   </td>

                   <td >
                       <label for="">{{ $item -> qty }}</label>
                   </td>

                   
                   <td  width="30%">
                       <label for="">1 = ${{ $item -> price }} <span class="text-danger">&</span> {{$item->qty}} = (${{$item->price * $item->qty}})</label>
                   </td>
                   

                   @php 
                   $file = App\Models\Product::where('id',$item->product_id)->first();
                   @endphp

                   <td>
                       @if($order->status == 'Pending')
                       <strong>
                       <span class="badge badge-pill badge-success" style="background: #418DB9; padding:7px;">No File </span>
                       </strong>

                       @elseif($order->status == 'processing')
                       <strong>
                       <span class="badge badge-pill badge-success" style="background: #418DB9; padding:7px;">No File </span>
                       </strong>

                       @elseif($order->status == 'picked')
                       <strong>
                       <span class="badge badge-pill badge-success" style="background: #418DB9; padding:7px;">No File </span>
                       </strong>

                       @elseif($order->status == 'Cancel')
                       <strong>
                       <span class="badge badge-pill badge-success" style="background: #418DB9; padding:7px;">No File </span>
                       </strong>

                       @elseif($order->status == 'delivered')
                       <strong>
                       <span class="badge badge-pill badge-success" style="background: #418DB9; padding:7px;">No File </span>
                       </strong>

                       @elseif($order->status == 'shipped')
                       <strong>
                       <span class="badge badge-pill badge-success" style="background: #418DB9; padding:7px;">No File </span>
                       </strong>

                       @elseif($order->status == 'confirm')
                       <a target="_blank" href="{{ asset('upload/pdf/'.$file->digital_file) }}">
                       <strong>
                       <span class="badge badge-pill badge-success" style="background: #FF0000; padding:7px;">Download Ready</span>
                       </strong>
                       </a>
                       @endif
                   </td>

                
                 </tr>
                @endforeach





            
            </tbody>
          </table>
       </div>

    </div> <!-- col-md-8: End -->

  </div> <!-- row >> Order Item Row: End -->




 @if($order -> status !== "delivered" )

  @else

      @if($order->return_reason == NULL)
      <form action="{{ route('return.order',$order->id) }}" method="post">
            @csrf

          <div class="form-group">
          <label for="label"> Order Return Reason:</label>
          <textarea name="return_reason" id="" class="form-control" cols="30" rows="05">Return Reason</textarea>    
          </div>

          <button type="submit" class="btn btn-danger" style="margin-bottom:20px;">Return Order</button>

          </form>
      @else
      <spanc class="badge badge-pill badge-warning" style="background: #d9534f; margin:20px; padding:20px;">You Have Send Return Request for this product</span>

      @endif

 
 @endif




        </div><!-- End row -->
    </div><!-- End container -->
</div> <!-- End body-content -->


@endsection
