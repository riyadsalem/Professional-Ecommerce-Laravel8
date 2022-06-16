@extends('admin.admin_master')
@section('admin')



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


      <!-- Content Wrapper. Contains page content -->
        <div class="container-full">


          <!-- Main content -->
          <section class="content">
            <div class="row">

              <!-- -------------------------Edit Sub-SubCategory Page----------------------------- -->
              <div class="col-12">
                <div class="box">
                  <div class="box-header with-border">
                    <h3 class="box-title">Edit Sub-SubCategory</h3>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <div class="table-responsive">

                    <form action="{{ route('subsubcategory.update')}}" method="post" enctype="multipart/form-data">
               @csrf 

               <input type="hidden" name="id" value=" {{ $subsubcategory->id }} "> 


               <div class="form-group">
                            <h5>
                              Category Select <span class="text-danger">*</span>
                            </h5>
                            <div class="controls">
                              <select name="category_id" class="form-control" >

                              <option value="" selected="" disabled="" >Select Category</option>

                                  @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ $category->id == $subsubcategory->category_id ? 'selected' : '' }} > {{ $category -> category_name_en }}</option>
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

                              
                              @foreach($subcategories as $subcategory)
                                <option value="{{ $subcategory->id }}" {{ $subcategory->id == $subsubcategory->subcategory_id ? 'selected' : '' }} > {{ $subcategory -> subcategory_name_en }}</option>
                                @endforeach

                              </select>
                              @error('subcategory_id') 
                                <span class="text-danger">{{ $message }}</span>
                              @enderror
                            </div>
                        </div>



                   <div class="form-group">
                       <h5>Sub-SubCategory English<span class="text-danger">*</span></h5>
                       <div class="controls">
                           <input  type="text" name="subsubcategory_name_en" class="form-control" value="{{ $subsubcategory -> subsubcategory_name_en }}"  >

                           @error('subsubcategory_name_en') 
                           <span class="text-danger">{{ $message }}</span>
                           @enderror

                        </div>
                   </div>

                   <div class="form-group">
                       <h5>Sub-SubCategory Arabic<span class="text-danger">*</span></h5>
                       <div class="controls">
                           <input type="text" name="subsubcategory_name_ar" class="form-control" value="{{ $subsubcategory -> subsubcategory_name_ar }}" >

                           @error('subsubcategory_name_ar') 
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