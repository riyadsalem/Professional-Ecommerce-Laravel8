@extends('frontend.main_master')
@section('content')


<div class="body-content">
    <div class="container">
        <div class="row">

        @include('frontend.common.user_sidebar')



            <div class="col-md-2">
            @yield('updateProfile')


            </div> <!-- End col-md-2 -->



            <div class="col-md-6">

                <div class="card">
                    <h3 class="text-center"><span class="text-danger">Hi...</span><strong>{{ Auth::user()->name }}</strong> Update Your Profile </h3>

                    <div class="card-body">
                        <form action="{{ route('user.profile.store') }}" method="post" enctype="multipart/form-data">
                            @csrf

                        <div class="form-group">
		                  <label class="info-title" for="exampleInputEmail1">Name<span></span></label>
		                  <input name="name" type="text" class="form-control" value="{{ $user -> name }}" >
		                </div>

                        <div class="form-group">
		                  <label class="info-title" for="exampleInputEmail1">Email<span></span></label>
		                  <input name="email" type="email" class="form-control" value="{{ $user -> email }}" >
		                </div>

                        <div class="form-group">
		                  <label class="info-title" for="exampleInputEmail1">Phone<span></span></label>
		                  <input name="phone" type="number" class="form-control" value="{{ $user -> phone }}" >
		                </div>

                        <div class="form-group">
		                  <label class="info-title" for="exampleInputEmail1">User Image<span></span></label>
		                  <input name="profile_photo_path" type="file" class="form-control">
		                </div>

                        <div class="form-group">
		                  <button type="submit" class="btn btn-danger">Update</button>
		                </div>



                        </form>
                    </div>

                </div>

           </div> <!-- End col-md-6 -->


        </div><!-- End row -->
    </div><!-- End container -->
</div> <!-- End body-content -->


@endsection
