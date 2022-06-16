@extends('admin.admin_master')
@section('admin')


      <!-- Content Wrapper. Contains page content -->
        <div class="container-full">


          <!-- Main content -->
          <section class="content">
            <div class="row">

              <!-- -------------------------Add Brand Page----------------------------- -->
              <div class="col-12">
                <div class="box">
                  <div class="box-header with-border">
                    <h3 class="box-title">Edit Brand</h3>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <div class="table-responsive">

                    <form action="{{ route('brand.update',$brand->id) }}" method="post" enctype="multipart/form-data">
               @csrf 
                          <input type="hidden" name="id" value=" {{ $brand->id }} "> <!-- من خلاله بستدعي ال id in controller من دون ما استدعيه من خلال الرابط  -->
                          <input type="hidden" name="old_image" value=" {{ $brand-> brnad_image }} ">


                   <div class="form-group">
                       <h5>Brand Name English<span class="text-danger">*</span></h5>
                       <div class="controls">
                           <input  type="text" name="brand_name_en" class="form-control" value="{{ $brand -> brand_name_en }}">

                           @error('brand_name_en') 
                           <span class="text-danger">{{ $message }}</span>
                           @enderror

                        </div>
                   </div>

                   <div class="form-group">
                       <h5>Brnad Name Arabic<span class="text-danger">*</span></h5>
                       <div class="controls">
                           <input type="text" name="brand_name_ar" class="form-control" value="{{ $brand -> brand_name_ar }}">

                           @error('brand_name_ar') 
                           <span class="text-danger">{{ $message }}</span>
                           @enderror

                        </div>
                   </div>

                   <div class="form-group">
                       <h5>Brand Image<span class="text-danger">*</span></h5>
                       <div class="controls">
                           <input type="file" name="brnad_image" class="form-control" >

                           @error('brnad_image') 
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