@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


        <div class="container-full">

          <!-- Main content -->
          <section class="content">
            <!-- Basic Forms -->
            <div class="box">
              <div class="box-header with-border">
                <h4 class="box-title">Edit Product </h4>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <div class="row">
                  <div class="col">

                    <form method="post" action="{{ route('product-update') }}"> 
                        @csrf
                        <input type="hidden" name="id" value="{{ $products -> id }}">

                      <div class="row">
                        <div class="col-12">


                        <div class="row"><!-- Start 1ST row -->

                            <div class="col-md-4">

                            <div class="form-group">
                            <h5>
                              Brand Select <span class="text-danger">*</span>
                            </h5>
                            <div class="controls">
                              <select name="brand_id" class="form-control" required="" >

                              <option value="" selected="" disabled="" >Select Brand</option>

                                  @foreach($brands as $brand)
                                <option value="{{ $brand->id }}" {{ ($brand->id == $products -> brand_id) ? 'selected' : '' }} >{{ $brand -> brand_name_en }}</option>
                                @endforeach

                              </select>
                              @error('brand_id') 
                                <span class="text-danger">{{ $message }}</span>
                              @enderror
                            </div>
                         </div>

                            </div><!-- End col-md-4 -->


                            <div class="col-md-4">

                            <div class="form-group">
                            <h5>
                              Category Select <span class="text-danger">*</span>
                            </h5>
                            <div class="controls">
                              <select name="category_id" class="form-control" required="">

                              <option value="" selected="" disabled="" >Select Category</option>

                                  @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ ($category->id == $products -> category_id) ? 'selected' : '' }} > {{ $category -> category_name_en }}</option>
                                @endforeach

                              </select>
                              @error('category_id') 
                                <span class="text-danger">{{ $message }}</span>
                              @enderror
                            </div>
                         </div>

                            </div><!-- End col-md-4 -->


                            <div class="col-md-4">

                            <div class="form-group">
                            <h5>
                              SubCategory Select <span class="text-danger">*</span>
                            </h5>
                            <div class="controls">
                              <select name="subcategory_id" class="form-control" required="" >

                              <option value="" selected="" disabled="" >Select SubCategory</option>

                              @foreach($subcategory as $sub)
                                <option value="{{ $sub->id }}" {{ ($sub->id == $products -> subcategory_id) ? 'selected' : '' }}>{{ $sub -> subcategory_name_en }}</option>
                                @endforeach


                              </select>
                              @error('subcategory_id') 
                                <span class="text-danger">{{ $message }}</span>
                              @enderror
                            </div>
                         </div>

                            </div><!-- End col-md-4 -->



                        </div><!-- End 1ST row -->


                        

                    <div class="row"><!-- Start 2EN row -->

                            <div class="col-md-4">

                            <div class="form-group">
                            <h5>
                            Sub-SubCategory Select <span class="text-danger">*</span>
                            </h5>
                            <div class="controls">
                              <select name="subsubcategory_id" class="form-control" required="" >

                              <option value="" selected="" disabled="" >Select Sub-SubCategory</option>

                              
                              @foreach($subsubcategory as $subsub)
                                <option value="{{ $subsub->id }}" {{ ($subsub->id == $products -> subsubcategory_id) ? 'selected' : '' }}>{{ $subsub -> subsubcategory_name_en }}</option>
                                @endforeach

                              </select>
                              @error('subsubcategory_id	') 
                                <span class="text-danger">{{ $message }}</span>
                              @enderror
                            </div>
                         </div>

                            </div><!-- End col-md-4 -->


                            <div class="col-md-4">

                            <div class="form-group">
                            <h5>
                             Product Name En <span class="text-danger">*</span>
                            </h5>
                            <div class="controls">
                              <input type="text" name="product_name_en" class="form-control" required="" value="{{ $products -> product_name_en }}" />

                             @error('product_name_en') 
                                <span class="text-danger">{{ $message }}</span>
                              @enderror

                            </div>
                         </div>

                            </div><!-- End col-md-4 -->


                            <div class="col-md-4">

                         <div class="form-group">
                            <h5>
                              Product Name Ar <span class="text-danger">*</span>
                            </h5>
                            <div class="controls">
                              <input type="text" name="product_name_ar" class="form-control" required=""  value="{{ $products -> product_name_ar }}" />

                              @error('product_name_ar') 
                                <span class="text-danger">{{ $message }}</span>
                              @enderror

                            </div>
                         </div>

                            </div><!-- End col-md-4 -->


                    </div><!-- End 2EN row -->




                    
                    <div class="row"><!-- Start 3RD row -->

                            <div class="col-md-4">

                            <div class="form-group">
                            <h5>
                             Product Code <span class="text-danger">*</span>
                            </h5>
                            <div class="controls">
                              <input type="text" name="product_code" class="form-control" required=""  value="{{ $products -> product_code }}"/>

                             @error('product_code') 
                                <span class="text-danger">{{ $message }}</span>
                              @enderror

                            </div>
                         </div>

                            </div><!-- End col-md-4 -->


                            <div class="col-md-4">

                            <div class="form-group">
                            <h5>
                             Product Quantity <span class="text-danger">*</span>
                            </h5>
                            <div class="controls">
                              <input type="text" name="product_qty" class="form-control" required=""  value="{{ $products -> product_qty }}" />

                             @error('product_qty') 
                                <span class="text-danger">{{ $message }}</span>
                              @enderror

                            </div>
                         </div>

                            </div><!-- End col-md-4 -->


                            <div class="col-md-4">

                         <div class="form-group">
                            <h5>
                              Product Tags En <span class="text-danger">*</span>
                            </h5>
                            <div class="controls">
                            <input type="text" name="product_tags_en" data-role="tagsinput" required=""  value="{{ $products -> product_tags_en }}"/>

                              @error('product_tags_en') 
                                <span class="text-danger">{{ $message }}</span>
                              @enderror

                            </div>
                         </div>

                            </div><!-- End col-md-4 -->


                    </div><!-- End 3RD row -->




                    
                    <div class="row"><!-- Start 4TH row -->

                            <div class="col-md-4">

                            <div class="form-group">
                            <h5>
                              Product Tags Ar <span class="text-danger">*</span>
                            </h5>
                            <div class="controls">
                            <input type="text" name="product_tags_ar"  data-role="tagsinput" required=""  value="{{ $products -> product_tags_ar }}"/>

                              @error('product_tags_ar') 
                                <span class="text-danger">{{ $message }}</span>
                              @enderror

                            </div>
                         </div>

                            </div><!-- End col-md-4 -->


                            <div class="col-md-4">

                            <div class="form-group">
                            <h5>
                              Product Size En <span class="text-danger">*</span>
                            </h5>
                            <div class="controls">
                            <input type="text" name="product_size_en" data-role="tagsinput" value="{{ $products -> product_size_en }}" />

                              @error('product_size_en') 
                                <span class="text-danger">{{ $message }}</span>
                              @enderror

                            </div>
                         </div>
                            </div><!-- End col-md-4 -->


                            <div class="col-md-4">

                            <div class="form-group">
                            <h5>
                              Product Size Ar <span class="text-danger">*</span>
                            </h5>
                            <div class="controls">
                            <input type="text" name="product_size_ar" data-role="tagsinput"  value="{{ $products -> product_size_ar }}" />

                              @error('product_size_ar') 
                                <span class="text-danger">{{ $message }}</span>
                              @enderror

                            </div>
                         </div>

                            </div><!-- End col-md-4 -->


                    </div><!-- End 4TH row -->


                                        
                    <div class="row"><!-- Start 5TH row -->

                            <div class="col-md-6">

                            <div class="form-group">
                            <h5>
                              Product Color En <span class="text-danger">*</span>
                            </h5>
                            <div class="controls">
                            <input type="text" name="product_color_en" data-role="tagsinput" value="{{ $products -> product_color_en }}" />

                              @error('product_color_en') 
                                <span class="text-danger">{{ $message }}</span>
                              @enderror

                            </div>
                         </div>

                            </div><!-- End col-md-6 -->


                            <div class="col-md-6">

                            <div class="form-group">
                            <h5>
                              Product Color Ar <span class="text-danger">*</span>
                            </h5>
                            <div class="controls">
                            <input type="text" name="product_color_ar" data-role="tagsinput" value="{{ $products -> product_color_ar }}" />

                              @error('product_color_ar') 
                                <span class="text-danger">{{ $message }}</span>
                              @enderror

                            </div>
                         </div>
                            </div><!-- End col-md-6 -->


                    </div><!-- End 5TH row -->

                    
                                        
                    <div class="row"><!-- Start 6TH row -->

                     <div class="col-md-6">

                            <div class="form-group">
                            <h5>
                              Product Selling Price <span class="text-danger">*</span>
                            </h5>
                            <div class="controls">
                            <input type="text" name="selling_price" class="form-control" required="" value="{{ $products -> selling_price }}"/>

                              @error('selling_price') 
                                <span class="text-danger">{{ $message }}</span>
                              @enderror

                            </div>
                         </div>

                    </div><!-- End col-md-6 -->

                    
                    <div class="col-md-6">

                        <div class="form-group">
                        <h5>
                          Product Discount Price <span class="text-danger">*</span>
                        </h5>
                        <div class="controls">
                        <input type="text" name="discount_price" class="form-control"  value="{{ $products -> discount_price }}"/>

                          @error('discount_price') 
                            <span class="text-danger">{{ $message }}</span>
                          @enderror

                        </div>
                        </div>

                    </div><!-- End col-md-6 -->


<!--  
                            <div class="col-md-4">

                            <div class="form-group">
                            <h5>
                              Main Thambnail <span class="text-danger">*</span>
                            </h5>
                            <div class="controls">
                            <input type="file" name="product_thambnail" class="form-control" onChange="mainThamUrl(this)" required=""  />

                              @error('product_thambnail') 
                                <span class="text-danger">{{ $message }}</span>
                              @enderror

                              <img src=" {{ asset( $products -> product_thambnail) }} " alt="" id="mainThmb" style="width:60px; hieght:60px">

                            </div>
                         </div>
                            </div>
                            --><!-- End col-md-4 -->

<!--  
                            <div class="col-md-4">

                            <div class="form-group">
                            <h5>
                              Multiple Image <span class="text-danger">*</span>
                            </h5>
                            <div class="controls">
                            <input type="file" name="multi_img[]" class="form-control" multiple="" id="multiImg" required="" />

                              @error('multi_img') 
                                <span class="text-danger">{{ $message }}</span>
                              @enderror
                              <div class="row" id="preview_img">
                                  
                              </div>

                            </div>
                         </div>

                            </div>--><!-- End col-md-4 -->


                    </div><!-- End 6TH row -->

                                                            
                    <div class="row"><!-- Start 7TH row -->

                            <div class="col-md-6">

                            <div class="form-group">
                            <h5>
                              Short Description English <span class="text-danger">*</span>
                            </h5>
                            <div class="controls">
                            <textarea name="short_descp_en" id="textarea" class="form-control" required placeholder="Textarea text"  >
                                {{  $products -> short_descp_en  }}
                            </textarea>
                            </div>
                         </div>

                            </div><!-- End col-md-6 -->


                            <div class="col-md-6">

                            <div class="form-group">
                            <h5>
                              Short Description Arabic <span class="text-danger">*</span>
                            </h5>
                            <div class="controls">
                            <textarea name="short_descp_ar" id="textarea" class="form-control" required placeholder="Textarea text" >
                            {{  $products -> short_descp_ar  }}

                            </textarea>
                            </div>
                         </div>
                            </div><!-- End col-md-6 -->


                    </div><!-- End 7TH row -->

                    
                                                            
                    <div class="row"><!-- Start 8TH row -->

                            <div class="col-md-6">

                            <div class="form-group">
                            <h5>
                              Long Description English <span class="text-danger">*</span>
                            </h5>
                            <div class="controls">
                            <textarea  id="editor1" name="long_descp_en" rows="10" cols="80" required="">
                            {{  $products -> long_descp_en  }}
                              </textarea>
                            </div>
                         </div>

                            </div><!-- End col-md-6 -->


                            <div class="col-md-6">

                            <div class="form-group">
                            <h5>
                              Long Description Arabic <span class="text-danger">*</span>
                            </h5>
                            <div class="controls">
                                <!-- روحت على backend/js/pages/editors.js >> وعملت editor2 وبعدين زبط كل واحد على حدى في ال frontend -->
                            <textarea  id="editor2" name="long_descp_ar" rows="10" cols="80" required="" >
                            {{  $products -> long_descp_ar  }}
                              </textarea>
                            </div>
                         </div>
                            </div><!-- End col-md-6 -->


                    </div><!-- End 8TH row -->


                 <hr>

                    <div class="row">

                      <div class="col-md-6">
                          <div class="form-group">
                            <div class="controls">
                              <fieldset>
                                <input type="checkbox" id="checkbox_2" name="hot_deals" value="1" 
                                {{ $products -> hot_deals ? 'checked' : '' }} />
                                <label for="checkbox_2">Hot Deals</label>
                              </fieldset>
                              <fieldset>
                                <input type="checkbox" id="checkbox_3" name="featured" value="1" 
                                 {{ $products -> featured ? 'checked' : '' }}/>
                                <label for="checkbox_3">Featured</label>
                              </fieldset>
                            </div>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group">
                            <div class="controls">
                              <fieldset>
                                <input type="checkbox" id="checkbox_4" name="special_offer" value="1"
                                {{ $products -> special_offer ? 'checked' : '' }} />
                                <label for="checkbox_4">Special Offer</label>
                              </fieldset>
                              <fieldset>
                                <input type="checkbox" id="checkbox_5" name="special_deals" value="1"
                                {{ $products -> special_deals ? 'checked' : '' }} />
                                <label for="checkbox_5">Special Deals</label>
                              </fieldset>
                            </div>
                          </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-6">
                      <div class="text-xs-right">
                      <Input type="submit" class="btn btn-rounded btn-info mb-5" value="Update Product ">
                      </div>

                    </form>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
          </section>
          <!-- /.content -->



          <!-- //////////////////// Start Multiple Image Update Area ////////////////////   -->


          <section class="content">
          <div class="col-md-12">
				<div class="box bt-3 border-info" style="padding:0px 0px 10px 20px">
				  <div class="box-header" style="margin:0px 0px 10px 0px; ">
					<h4 class="box-title">Product Multiple Image <strong>Update</strong></h4>
				  </div><br>

                  <form action="{{ route('update-product-image') }}" method="post" enctype="multipart/form-data">
                      @csrf
                      <div class="row row-sm">

                      @foreach($multiImgs as $img)
                          <div class="col-md-4">

                           <div class="card" style="width: 18rem;">
                             <img src=" {{ asset( $img -> photo_name ) }}" class="card-img-top" style="height:100%; width:100%;">

                             <div class="card-body">

                               <h5 class="card-title">
                                   <a href=" {{ route('product.multiimg.delete', $img -> id) }}" class="btn btn-sm btn-danger"  title="Delete Data"><i class="fa fa-trash"></i></a>
                               </h5>

                               <p class="card-text">
                                   <div class="form-group">
                                       <label for="" class="form-control-label">Change Image <span class="tx-danger">*</span></label>
                                       <input type="file" class="form-control" name="multi_img[{{ $img->id }}]" required ="">
                                       
                                   </div>
                               </p>
                             </div>
                           </div>

                          </div> <!-- end col-md-3 -->
                          @endforeach
                      </div><!-- end row row-sm -->


                      <div class="form-layout-footer">
                      <Input type="submit" class="btn btn-rounded btn-info mb-5 " value="Update Images">
                      </div><br>

                  </form>



              <!-- ////////////////////  Start Multiple Image Add Area ////////////////////  -->


                     <div class="col-md-12">

                        <form action="{{ route('add.multiple.image.editpage') }}" method="post" enctype="multipart/form-data">
                           @csrf
                           <input type="hidden" name="id" value="{{ $products -> id }}">
                   
                   
                         <div class="form-group">
                           <h5>
                           Add Multiple Image <span class="text-danger">*</span>
                           </h5>
                          <div class="controls">
                            <input type="file" name="multi_img[]" class="form-control" multiple="" id="multiImg"  required=""
                            />
                   
                            @error('multi_img') 
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                             <div class="row" id="preview_img">
                   
                             </div>
                   
                          </div>
                   
                         </div>
                   
                           <div class="form-layout-footer">
                           <Input type="submit" class="btn btn-rounded btn-info mb-5 " value="Add Image">
                           </div><br>
                   
                        </form>
                   
                       </div>

                       </div>
			  </div>





              <!-- ////////////////////  End Multiple Image Add Area ////////////////////  -->





              </section>


          <!-- //////////////////// End Multiple Image Update Area ////////////////////   -->




          
          <!-- //////////////////// Start Thambnail Image Update Area ////////////////////   -->


          <section class="content">
          <div class="col-md-12">
				<div class="box bt-3 border-info" style="padding:0px 0px 10px 20px">
				  <div class="box-header" style="margin:0px 0px 10px 0px; ">
					<h4 class="box-title">Product Thambnail Image <strong>Update</strong></h4>
				  </div><br>

                  <form action="{{ route('update-product-image-thambnail') }}" method="post" enctype="multipart/form-data">
                      @csrf

                      <input type="hidden" name="id" id="" value="{{ $products -> id }}">
                      <input type="hidden" name="old_img" value="{{ $products -> product_thambnail }}">

                      <div class="row row-sm">

                          <div class="col-md-4">

                           <div class="card" style="width: 18rem;">
                             <img src=" {{ asset( $products -> product_thambnail ) }}" class="card-img-top" style="height:100%; width:100%;">

                             <div class="card-body">

                               <h5 class="card-title">
                                   <a href="" class="btn btn-sm btn-danger" id="delete" title="Delete Data"><i class="fa fa-trash"></i></a>
                               </h5>

                               <p class="card-text">
                                   <div class="form-group">
                                       <label for="" class="form-control-label">Change Image <span class="tx-danger">*</span></label>
                                       <input type="file" class="form-control" name="product_thambnail"  onChange="mainThamUrl(this)">

                                       <img alt="" id="mainThmb" style="width:60px; hieght:60px">
                                   </div>
                               </p>
                             </div>
                           </div>

                          </div> <!-- end col-md-3 -->

                      </div><!-- end row row-sm -->


                      <div class="form-layout-footer">
                      <Input type="submit" class="btn btn-rounded btn-info mb-5 " value="Update Image">
                      </div><br>

                  </form>

				</div>
			  </div>
              </section>


          <!-- //////////////////// End Thambnail Image Update Area ////////////////////   -->





        </div>



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
                       $('select[name="subsubcategory_id"]').html('');
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


        $('select[name="subcategory_id"]').on('change', function(){
            var subcategory_id = $(this).val();
            if(subcategory_id) {
                $.ajax({
                    url: "{{  url('/category/sub-subcategory/ajax') }}/"+subcategory_id,
                    type:"GET",
                    dataType:"json",
                    success:function(data) {
                       var d =$('select[name="subsubcategory_id"]').empty();
                          $.each(data, function(key, value){
                              $('select[name="subsubcategory_id"]').append('<option value="'+ value.id +'">' + value.subsubcategory_name_en + '</option>');
                          });
                    },
                });
            } else {
                alert('danger');
            }
        });



    });
    </script>



<script type="text/javascript">

function mainThamUrl(input){
    if(input.files && input.files[0]){
        var reader = new FileReader();
        reader.onload = function(e){
            $('#mainThmb').attr('src',e.target.result).width(80).height(80);
        };
        reader.readAsDataURL(input.files[0]);
    }
}

</script>


<script>
 
  $(document).ready(function(){
   $('#multiImg').on('change', function(){ //on file input change
      if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
      {
          var data = $(this)[0].files; //this file data
           
          $.each(data, function(index, file){ //loop though each file
              if(/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)){ //check supported file type
                  var fRead = new FileReader(); //new filereader
                  fRead.onload = (function(file){ //trigger function on successful read
                  return function(e) {
                      var img = $('<img/>').addClass('thumb').attr('src', e.target.result) .width(80)
                  .height(80); //create image element 
                      $('#preview_img').append(img); //append image to output element
                  };
                  })(file);
                  fRead.readAsDataURL(file); //URL representing the file's data.
              }
          });
           
      }else{
          alert("Your browser doesn't support File API!"); //if File API is absent
      }
   });
  });
   
  </script>









@endsection