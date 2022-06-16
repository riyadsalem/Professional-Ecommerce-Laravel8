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
                    <h3 class="box-title">Slider List <span class="badge badge-pill badge-danger"> {{ count($sliders) }} </span></h3>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <div class="table-responsive">
                      <table
                        id="example1"
                        class="table table-bordered table-striped">

                        <thead>
                          <tr>
                          <th>Slider Image</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach($sliders as $item)
                          <tr>
                          <td><img src=" {{ asset($item -> slider_img) }} " alt="" style="width:60px; height:50px">
                        </td>
                            <td>
                                @if( $item -> title == Null)
                                <span class="badge badge-pill badge-danger"> No Title </span>
                                @else
                                 {{ $item -> title }} 
                                @endif
                            </td>

                            <td>
                                @if( $item -> description == Null)
                                <span class="badge badge-pill badge-danger"> No Description </span>
                                @else
                                 {{ $item -> description }} 
                                @endif
                            </td>

                            <td>
                                @if( $item -> status == 1)
                                <span class="badge badge-pill badge-success"> Active </span>
                                @else
                                <span class="badge badge-pill badge-danger"> InActive </span>
                                @endif
                            </td>

                            <td width="25%">
                                <a href="{{ route('slider.edit',$item->id) }}" class="btn btn-info btn-sm" title="Edit Data"><i class="fa fa-pencil"></i></a>

                                <a href="{{ route('slider.delete',$item->id) }}" class="btn btn-danger btn-sm" id="" title="Delete Data"><i class="fa fa-trash"></i></a>

                                @if( $item -> status == 1)
                                <a href="{{ route('slider.inactive',$item->id) }}" class="btn btn-danger btn-sm" title="Inactive Now"><i class="fa fa-arrow-down"></i></a>
                                @else
                                <a href="{{ route('slider.active',$item->id) }}" class="btn btn-success btn-sm" title="Active Now"><i class="fa fa-arrow-up"></i></a>
                                @endif

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




              <!-- -------------------------Add Slider Page----------------------------- -->
              <div class="col-4">
                <div class="box">
                  <div class="box-header with-border">
                    <h3 class="box-title">Add Slider</h3>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <div class="table-responsive">

                    <form action="{{ route('slider.store') }}" method="post" enctype="multipart/form-data">
               @csrf 

                   <div class="form-group">
                       <h5>Slider Title<span class="text-danger">*</span></h5>
                       <div class="controls">
                           <input type="text" name="title" class="form-control" >
                        </div>
                   </div>

                   <div class="form-group">
                       <h5>Slider Description<span class="text-danger">*</span></h5>
                       <div class="controls">
                           <input type="text" name="description" class="form-control" >
                        </div>
                   </div>

                   <div class="form-group">
                       <h5>Slider Image<span class="text-danger">*</span></h5>
                       <div class="controls">
                           <input  type="file" name="slider_img" class="form-control" >

                           @error('slider_img') 
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