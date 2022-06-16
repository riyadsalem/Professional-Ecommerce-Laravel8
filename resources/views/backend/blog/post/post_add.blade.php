@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


        <div class="container-full">

          <!-- Main content -->
          <section class="content">
            <!-- Basic Forms -->
            <div class="box">
              <div class="box-header with-border">
                <h4 class="box-title">Add Post </h4>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <div class="row">
                  <div class="col">

                    <form method="post" action="{{ route('post.store') }}" enctype="multipart/form-data"> 
                        @csrf

                      <div class="row">
                        <div class="col-12">
                       

                    <div class="row"><!-- Start 2EN row -->

                            <div class="col-md-6">

                            <div class="form-group">
                            <h5>
                             Post Title En <span class="text-danger">*</span>
                            </h5>
                            <div class="controls">
                              <input type="text" name="post_title_en" class="form-control" required="" />

                             @error('post_title_en') 
                                <span class="text-danger">{{ $message }}</span>
                              @enderror

                            </div>
                         </div>

                            </div><!-- End col-md-6-->


                            <div class="col-md-6">

                         <div class="form-group">
                            <h5>
                              Post Title Ar <span class="text-danger">*</span>
                            </h5>
                            <div class="controls">
                              <input type="text" name="post_title_ar" class="form-control" required="" />

                              @error('post_title_ar') 
                                <span class="text-danger">{{ $message }}</span>
                              @enderror

                            </div>
                         </div>

                            </div><!-- End col-md-6-->


                    </div><!-- End 2EN row -->
                    
                                        
                    <div class="row"><!-- Start 6TH row -->

                            <div class="col-md-6">

                            <div class="form-group">
                            <h5>
                            Blog Category Select <span class="text-danger">*</span>
                            </h5>
                            <div class="controls">
                            <select name="category_id" class="form-control" required="" >

                            <option value="" selected="" disabled="" >Select Blog Category</option>

                                 @foreach($blogcategory as $category)
                                <option value="{{ $category->id }}">{{ $category -> blog_category_name_en }}</option>
                                @endforeach

                            </select>
                            @error('category_id') 
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>
                            </div>

                            </div><!-- End col-md-6 -->



                            <div class="col-md-6">

                            <div class="form-group">
                            <h5>
                              Post Main Image <span class="text-danger">*</span>
                            </h5>
                            <div class="controls">
                            <input type="file" name="post_image" class="form-control" onChange="mainThamUrl(this)" required="" />

                              @error('post_image') 
                                <span class="text-danger">{{ $message }}</span>
                              @enderror

                              <img src="" alt="" id="mainThmb">

                            </div>
                         </div>
                            </div><!-- End col-md-6-->


                    </div><!-- End 6TH row -->

                    
                                                            
                    <div class="row"><!-- Start 8TH row -->

                            <div class="col-md-6">

                            <div class="form-group">
                            <h5>
                              Post Details English <span class="text-danger">*</span>
                            </h5>
                            <div class="controls">
                            <textarea  id="editor1" name="post_details_en" rows="10" cols="80" required="">
                              Post Details English
                              </textarea>
                            </div>
                         </div>

                            </div><!-- End col-md-6 -->


                            <div class="col-md-6">

                            <div class="form-group">
                            <h5>
                              Post Details Arabic <span class="text-danger">*</span>
                            </h5>
                            <div class="controls">
                                <!-- روحت على backend/js/pages/editors.js >> وعملت editor2 وبعدين زبط كل واحد على حدى في ال frontend -->
                            <textarea  id="editor2" name="post_details_ar" rows="10" cols="80" required="" >
                              Post Details Arabic
                              </textarea>
                            </div>
                         </div>
                            </div><!-- End col-md-6 -->

                    </div><!-- End 8TH row -->
                 <hr>

                     <div class="text-xs-right">
                      <Input type="submit" class="btn btn-rounded btn-info" value="Add Post ">
                      </div>

                    </form>

              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
          </section>
          <!-- /.content -->
        </div>


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










@endsection