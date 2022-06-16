@extends('admin.admin_master')
@section('admin')


      <!-- Content Wrapper. Contains page content -->
        <div class="container-full">


          <!-- Main content -->
          <section class="content">
            <div class="row">

              <!-- -------------------------Edit Blog Category Page----------------------------- -->
              <div class="col-8">
                <div class="box">
                  <div class="box-header with-border">
                    <h3 class="box-title">Edit Blog Category</h3>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <div class="table-responsive">

                    <form action="{{ route('blogcategory.update') }}" method="post">
               @csrf 

               <input type="hidden" name="id" value="{{ $blogcategory->id }}">
               
                   <div class="form-group">
                       <h5>Blog Category Name English<span class="text-danger"></span></h5>
                       <div class="controls">
                           <input  type="text" name="blog_category_name_en" class="form-control" value="{{ $blogcategory->blog_category_name_en }}" >

                           @error('blog_category_name_en') 
                           <span class="text-danger">{{ $message }}</span>
                           @enderror

                        </div>
                   </div>

                   <div class="form-group">
                       <h5>Blog Category Name Arabic<span class="text-danger"></span></h5>
                       <div class="controls">
                           <input type="text" name="blog_category_name_ar" class="form-control" value="{{ $blogcategory->blog_category_name_ar }}" >

                           @error('blog_category_name_ar') 
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