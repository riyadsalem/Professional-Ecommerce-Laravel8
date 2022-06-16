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
                    <h3 class="box-title">SubCategory List <span class="badge badge-pill badge-danger"> {{ count($subcategory) }} </span></h3>
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
                          <th>Category</th>
                            <th width="10%">SubCategory En</th>
                            <th>SubCategory Ar</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach($subcategory as $item)
                          <tr>
                          <td><span>{{ $item['category']['category_name_en'] }}</span></td>
                            <td width="10%">{{ $item -> subcategory_name_en }}</td>
                            <td>{{ $item -> subcategory_name_ar }}</td>
                            <td width="25%">
                                <a href="{{ route('subcategory.edit',$item->id) }}" class="btn btn-info" title="Edit Data"><i class="fa fa-pencil"></i></a>
                                <a href="{{ route('subcategory.delete',$item->id) }}" class="btn btn-danger" id="" title="Delete Data"><i class="fa fa-trash"></i></a>

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




              <!-- -------------------------Add Category Page----------------------------- -->
              <div class="col-4">
                <div class="box">
                  <div class="box-header with-border">
                    <h3 class="box-title">Add SubCategory</h3>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <div class="table-responsive">

                    <form action="{{ route('subcategory.store') }}" method="post" enctype="multipart/form-data">
               @csrf 

                         <div class="form-group">
                            <h5>
                              Category Select <span class="text-danger">*</span>
                            </h5>
                            <div class="controls">
                              <select name="category_id" class="form-control" >

                              <option value="" selected="" disabled="" >Select Category</option>

                                  @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category -> category_name_en }}</option>
                                @endforeach

                              </select>
                              @error('category_id') 
                                <span class="text-danger">{{ $message }}</span>
                              @enderror
                            </div>
                        </div>




                   <div class="form-group">
                       <h5>SubCategory English<span class="text-danger">*</span></h5>
                       <div class="controls">
                           <input  type="text" name="subcategory_name_en" class="form-control" >

                           @error('subcategory_name_en') 
                           <span class="text-danger">{{ $message }}</span>
                           @enderror

                        </div>
                   </div>

                   <div class="form-group">
                       <h5>SubCategory Arabic<span class="text-danger">*</span></h5>
                       <div class="controls">
                           <input type="text" name="subcategory_name_ar" class="form-control" >

                           @error('subcategory_name_ar') 
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