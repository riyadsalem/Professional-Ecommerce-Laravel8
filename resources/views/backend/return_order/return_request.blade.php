
@extends('admin.admin_master')
@section('admin')


      <!-- Content Wrapper. Contains page content -->
        <div class="container-full">


          <!-- Main content -->
          <section class="content">
            <div class="row">

              <div class="col-12">
                <div class="box">
                  <div class="box-header with-border">
                    <h3 class="box-title">Return Orders List <span class="badge badge-pill badge-danger"> {{ count($orders) }} </span> </h3>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <div class="table-responsive">
                      <table
                        id="example1"
                        class="table table-bordered table-striped"
                      >
                        <thead>
                          <tr>
                          <th>Date </th>
                            <th>Invoice </th>
                            <th> Amount </th>
                            <th> Payment </th>
                            <th> Return Reason </th>
                            <th> Status </th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $item)
                          <tr>
                            <td > {{ $item -> order_date }} </td>
                            <td> {{ $item -> invoice_no }} </td>
                            <td> 
                              @if($item->payment_type == 'Stripe')
                              ${{ $item -> amount / 100 }}
                              @else
                              ${{ $item -> amount }}
                              @endif
                            </td>
                            <td> {{ $item -> payment_type }} </td>
                            <td width="15"> {{ Str::limit($item -> return_reason , 20) }} </td>

                            @if($item->return_order == 1)
                            <td > <span class="badge badge-pill badge-primary">Pending 💠</span> </td>
                            @elseif($item->return_order == 2)
                            <td > <span class="badge badge-pill badge-success">Success :grey_exclamation:</span> </td>

                            @endif

                            <td width="25%">
                                <a href="{{ route('pending.order.details',$item->id) }}" class="btn btn-info " title="Edit Data"><i class="fa fa-eye"></i></a>

                                <a target="_blank" href="{{ route('invoice.download',$item->id) }}" class="btn btn-danger " id="" title="Invoice Download"><i class="fa fa-download"></i></a>

                                <a href="{{ route('return.approve',$item->id) }}" class="btn btn-success"> Approve </a>

                            </td>
                          </tr>
                          @endforeach
                          
                        </tbody>
                        
                      </table>
                    </div>
                  </div>
                  <!-- /.box-body -->
                </div>
                <!-- /.box -->

                <!-- /.box -->
              </div>
              <!-- /.col -->





            </div>
            <!-- /.row -->
          </section>
          <!-- /.content -->
        </div>
      <!-- /.content-wrapper -->


@endsection