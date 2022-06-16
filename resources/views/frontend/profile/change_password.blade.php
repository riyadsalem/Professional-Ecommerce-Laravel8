@extends('frontend.main_master')
@section('content')
<!--  
@php 
$user = DB::table('users')->where('id',Auth::user()->id)->first();
@endphp 
-->

<div class="body-content">
    <div class="container">
        <div class="row">

        @include('frontend.common.user_sidebar')



            <div class="col-md-2">


            </div> <!-- End col-md-2 -->



            <div class="col-md-6">

                <div class="card">
                    <h3 class="text-center"><span class="text-danger">Change Password<span></h3>

                    <div class="card-body">
                        <form action="{{ route('user.password.update') }}" method="post">
                            @csrf

                        <div class="form-group">
		                  <label class="info-title" for="exampleInputEmail1">Current Password<span></span></label>
		                  <input id="current_password" name="oldpassword" type="password" class="form-control">
		                </div>

                        <div class="form-group">
		                  <label class="info-title" for="exampleInputEmail1">New Password<span></span></label>
		                  <input id="password" name="password" type="password" class="form-control" >
		                </div>

                        <div class="form-group">
		                  <label class="info-title" for="exampleInputEmail1">Confirm Password<span></span></label>
		                  <input id="password_confirmation" name="password_confirmation" type="password" class="form-control"  >
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
