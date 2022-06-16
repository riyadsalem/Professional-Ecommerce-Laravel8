@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


      <!-- Content Wrapper. Contains page content -->
        <div class="container-full">


          <!-- Main content -->
          <section class="content">
            <div class="row">

              <div class="col-8">
                <div class="box">
                  <div class="box-header with-border">
                    <h3 class="box-title">Sub -> SubCategory List <span class="badge badge-pill badge-danger"> {{ count($subsubcategory) }} </span></h3>
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
                          <th>SubCategory Name</th>
                            <th>Sub-SubCategory En</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach($subsubcategory as $item)
                          <tr>
                          <td><span>{{ $item['category']['category_name_en'] }}</span></td>
                          <td><span>{{ $item['subcategory']['subcategory_name_en'] }}</span></td>
                            <td>{{ $item -> subsubcategory_name_en }}</td>
                            <td width="25%">
                                <a href="{{ route('subsubcategory.edit',$item->id) }}" class="btn btn-info" title="Edit Data"><i class="fa fa-pencil"></i></a>
                                <a href="{{ route('subsubcategory.delete',$item->id) }}" class="btn btn-danger" id="" title="Delete Data"><i class="fa fa-trash"></i></a>

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




              <!-- -------------------------Add Sub-SubCategory Page----------------------------- -->
              <div class="col-4">
                <div class="box">
                  <div class="box-header with-border">
                    <h3 class="box-title">Add Sub-SubCategory</h3>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <div class="table-responsive">

                    <form action="{{ route('subsubcategory.store') }}" method="post" enctype="multipart/form-data">
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
                            <h5>
                              SubCategory Select <span class="text-danger">*</span>
                            </h5>
                            <div class="controls">
                              <select name="subcategory_id" class="form-control" >

                              <option value="" selected="" disabled="" >Select Category</option>



                              </select>
                              @error('subcategory_id') 
                                <span class="text-danger">{{ $message }}</span>
                              @enderror
                            </div>
                        </div>



                   <div class="form-group">
                       <h5>Sub-SubCategory English<span class="text-danger">*</span></h5>
                       <div class="controls">
                           <input  type="text" name="subsubcategory_name_en" class="form-control" >

                           @error('subsubcategory_name_en') 
                           <span class="text-danger">{{ $message }}</span>
                           @enderror

                        </div>
                   </div>

                   <div class="form-group">
                       <h5>Sub-SubCategory Arabic<span class="text-danger">*</span></h5>
                       <div class="controls">
                           <input type="text" name="subsubcategory_name_ar" class="form-control" >

                           @error('subsubcategory_name_ar') 
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

      <script type="text/javascript">
      $(document).ready(function() {
        $('select[name="category_id"]').on('change', function(){
            var category_id = $(this).val();
            if(category_id) {
                $.ajax({
                     // category >> prefix
                    // subcategory/ajax > Route url >Route::get('/subcategory/ajax/{category_id}', [SubCategoryController::class, 'GetSubCategory']); 
                    url: "{{  url('/category/subcategory/ajax') }}/"+category_id,
                    type:"GET",
                    dataType:"json",
                    success:function(data) {
                       var d =$('select[name="subcategory_id"]').empty();
                          $.each(data, function(key, value){
                              $('select[name="subcategory_id"]').append('<option value="'+ value.id +'">' + value.subcategory_name_en + '</option>');
                          });
                    },
                });
            } else {
                alert('danger');
            }
        });
    });
    </script>


@endsection