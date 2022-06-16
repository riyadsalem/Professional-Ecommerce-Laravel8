@extends('admin.admin_master')
@section('admin')


      <!-- Content Wrapper. Contains page content -->
        <div class="container-full">


          <!-- Main content -->
          <section class="content">
            <div class="row">

              <div class="col-8">
                <div class="box">
                  <div class="box-header with-border">
                    <h3 class="box-title">Brnad List <span class="badge badge-pill badge-danger"> {{ count($brands) }} </span></h3>
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
                            <th>Brand En</th>
                            <th>Brnad Ar</th>
                            <th>Image</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach($brands as $itme)
                          <tr>
                            <td>{{ $itme -> brand_name_en }}</td>
                            <td>{{ $itme -> brand_name_ar }}</td>
                            <td><img src="{{asset($itme -> brnad_image) }}" style="width:70px; height:40px"></td>
                            <td>
                                <a href="{{ route('brand.edit',$itme->id) }}" class="btn btn-info" title="Edit Data"><i class="fa fa-pencil"></i></a>
                                <a href="{{ route('brand.delete',$itme->id) }}" class="btn btn-danger" id="" title="Delete Data"><i class="fa fa-trash"></i></a>

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




              <!-- -------------------------Add Brand Page----------------------------- -->
              <div class="col-4">
                <div class="box">
                  <div class="box-header with-border">
                    <h3 class="box-title">Add Brand</h3>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <div class="table-responsive">

                    <form action="{{ route('brand.store') }}" method="post" enctype="multipart/form-data">
               @csrf 

                   <div class="form-group">
                       <h5>Brand Name English<span class="text-danger">*</span></h5>
                       <div class="controls">
                           <input  type="text" name="brand_name_en" class="form-control" >

                           @error('brand_name_en') 
                           <span class="text-danger">{{ $message }}</span>
                           @enderror

                        </div>
                   </div>

                   <div class="form-group">
                       <h5>Brnad Name Arabic<span class="text-danger">*</span></h5>
                       <div class="controls">
                           <input type="text" name="brand_name_ar" class="form-control" >

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
                   <Input type="submit" class="btn btn-rounded btn-info" value="Add New">
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