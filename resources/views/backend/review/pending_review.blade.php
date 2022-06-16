
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
                    <h3 class="box-title">Pending All Reviews <span class="badge badge-pill badge-danger"> {{ count($review) }} </span> </h3>
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
                          <th>Summay</th>
                            <th>Comment</th>
                            <th>User Name</th>
                            <th>User Email</th>
                            <th>Product</th>
                            <th> Status </th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach($review as $item)
                          <tr>
                            <td > {{ $item -> summary }} </td>
                            <td> {{ $item -> comment }} </td>
                            <td> {{ $item->user->name }} </td>
                            <td> <a href="mailto:{{$item->user->email}}"> {{ $item->user->email }} </a></td>
                            <td> {{ $item->product->product_name_en }} </td>

                            @if($item->status == 0)
                            <td > <span class="badge badge-pill badge-primary">Pending 💠</span> </td>
                            @elseif($item->status == 1)
                            <td > <span class="badge badge-pill badge-success">Publish</span> </td>
                            @endif

                            <td width="10%">

                                <a href="{{ route('review.approve',$item->id) }}" class="btn btn-danger"> Approve </a>

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