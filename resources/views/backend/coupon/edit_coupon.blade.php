@extends('admin.admin_master')
@section('admin')


      <!-- Content Wrapper. Contains page content -->
        <div class="container-full">


          <!-- Main content -->
          <section class="content">
            <div class="row">

              <!-- -------------------------Update Coupon Page----------------------------- -->
              <div class="col-12">
                <div class="box">
                  <div class="box-header with-border">
                    <h3 class="box-title">Edit Coupon</h3>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <div class="table-responsive">

                    <form action="{{ route('coupon.update', $coupons->id) }}" method="post">
               @csrf 

               <input type="hidden" value="{{ $coupons->id }}">
                   <div class="form-group">
                       <h5>Coupon Name</h5>
                       <div class="controls">
                           <input  type="text" name="coupon_name" class="form-control"  value="{{ $coupons -> coupon_name }}">

                           @error('coupon_name') 
                           <span class="text-danger">{{ $message }}</span>
                           @enderror

                        </div>
                   </div>

                   <div class="form-group">
                       <h5>Coupon Discount(%)</h5>
                       <div class="controls">
                           <input type="text" name="coupon_discount" class="form-control" min="1" value="{{ $coupons -> coupon_discount }} " >

                           @error('coupon_discount') 
                           <span class="text-danger">{{ $message }}</span>
                           @enderror

                        </div>
                   </div>

                   <div class="form-group">
                       <h5>Coupon Validity Date</h5>
                       <div class="controls">
                           <input type="date" name="coupon_validity" class="form-control" min="{{ Carbon\Carbon::now()->format('Y-m-d') }}" value="{{ $coupons->coupon_validity }}" >

                           @error('coupon_validity') 
                           <span class="text-danger">{{ $message }}</span>
                           @enderror

                        </div>
                   </div>




                
               <div class="text-xs-right">
                   <Input type="submit" class="btn btn-rounded btn-info" value="Update">
               </div>
           </form>
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