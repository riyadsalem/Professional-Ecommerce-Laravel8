@extends('admin.admin_master')
@section('admin')


      <!-- Content Wrapper. Contains page content -->
        <div class="container-full">


          <!-- Main content -->
          <section class="content">
            <div class="row">

              <!-- ------------//////-------------Add Search By Date: Start -------------//////---------------- -->
              <div class="col-4">
                <div class="box">
                  <div class="box-header with-border">
                    <h3 class="box-title">Search By Date</h3>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <div class="table-responsive">

                    <form action="{{ route('search-by-date') }}" method="post">
               @csrf 

                   <div class="form-group">
                       <h5>Select Date<span class="text-danger">*</span></h5>
                       <div class="controls">
                           <input  type="date" name="date" class="form-control" >

                           @error('date') 
                           <span class="text-danger">{{ $message }}</span>
                           @enderror

                        </div>
                   </div>
                
               <div class="text-xs-right">
                   <Input type="submit" class="btn btn-rounded btn-info" value="Search">
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
              <!-- -----------//////--------------Add Search By Date: End------------//////----------------- -->




              <!-- ------------//////-------------Add Search By Month & Year: Start -------------//////---------------- -->
              <div class="col-4">
                <div class="box">
                  <div class="box-header with-border">
                    <h3 class="box-title">Search By Month</h3>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <div class="table-responsive">

                    <form action="{{ route('search-by-month') }}" method="post">
               @csrf 

                   <div class="form-group">
                       <h5>Select Month<span class="text-danger">*</span></h5>
                       <div class="controls">
                           <select name="month" class="form-control">
                               <option label="Choose One"></option>
                               <option value="January">January</option>
                               <option value="February">February</option>
                               <option value="March">March</option>
                               <option value="April">April</option>
                               <option value="May">May</option>
                               <option value="Jun">Jun</option>
                               <option value="July">July</option>
                               <option value="August">August</option>
                               <option value="September">September</option>
                               <option value="October">October</option>
                               <option value="November">November</option>
                               <option value="December">December</option>
                           </select>

                           @error('month') 
                           <span class="text-danger">{{ $message }}</span>
                           @enderror

                        </div>
                   </div>
                


                   <div class="form-group">
                       <h5>Select Year<span class="text-danger">*</span></h5>
                       <div class="controls">
                           <select name="year_name" class="form-control">
                               <option label="Choose One"></option>
                               <option value="2022">2022</option>
                               <option value="2023">2023</option>
                               <option value="2024">2024</option>
                               <option value="2025">2025</option>
                               <option value="2026">2026</option>
                               <option value="2027">2027</option>
                               <option value="2028">2028</option>
                           </select>

                           @error('year_name') 
                           <span class="text-danger">{{ $message }}</span>
                           @enderror

                        </div>
                   </div>




               <div class="text-xs-right">
                   <Input type="submit" class="btn btn-rounded btn-info" value="Search">
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
              <!-- -----------//////--------------Add Search By Month & Year: End------------//////----------------- -->





              <!-- ------------//////-------------Add Search Year: Start -------------//////---------------- -->
              <div class="col-4">
                <div class="box">
                  <div class="box-header with-border">
                    <h3 class="box-title">Search Year</h3>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <div class="table-responsive">

                    <form action="{{ route('search-by-year') }}" method="post">
               @csrf 

               <div class="form-group">
                       <h5>Select Year<span class="text-danger">*</span></h5>
                       <div class="controls">
                           <select name="year" class="form-control">
                               <option label="Choose One"></option>
                               <option value="2022">2022</option>
                               <option value="2023">2023</option>
                               <option value="2024">2024</option>
                               <option value="2025">2025</option>
                               <option value="2026">2026</option>
                               <option value="2027">2027</option>
                               <option value="2028">2028</option>
                           </select>

                           @error('year') 
                           <span class="text-danger">{{ $message }}</span>
                           @enderror

                        </div>
                   </div>

                
               <div class="text-xs-right">
                   <Input type="submit" class="btn btn-rounded btn-info" value="Search">
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
              <!-- -----------//////--------------Add Search Year: End------------//////----------------- -->




            </div>
            <!-- /.row -->
          </section>
          <!-- /.content -->
        </div>
      <!-- /.content-wrapper -->


@endsection