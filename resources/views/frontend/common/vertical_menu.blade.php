
@php
$categories = App\Models\Category::orderBy('category_name_en','ASC')->get();
@endphp

<div class="side-menu animate-dropdown outer-bottom-xs">
          <div class="head"><i class="icon fa fa-align-justify fa-fw"></i> 
          @if(session()->get('language') == 'arabic')
          التصنيفات
          @else
          Categories
          @endif
        </div>
          <nav class="yamm megamenu-horizontal">

          @foreach($categories as $category)
            <ul class="nav">
              <li class="dropdown menu-item">
                 <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon {{ $category ->  category_icon }}" aria-hidden="true"></i>
                     @if(session()->get('language') == 'arabic')
                     {{ $category -> category_name_ar }}
                     @else
                     {{ $category -> category_name_en }}
                     @endif
                 </a>

                <ul class="dropdown-menu mega-menu">
                  <li class="yamm-content">
                    <div class="row">

                    <!-- Get SubCategory Table Data -->
                    @php 
                    $subcategories = App\Models\SubCategory::where('category_id',$category->id)->orderBy     ('subcategory_name_en','ASC')->get();
                    @endphp

                    @foreach($subcategories as $subcategory)

                      <div class="col-sm-12 col-md-3">
                        <a href="{{ url('subcategory/product/'.$subcategory->id.'/'.$subcategory->subcategory_slug_en ) }}">
                      <h2 class="title">
                            @if(session()->get('language') == 'arabic')
                             {{ $subcategory -> subcategory_name_ar }}
                             @else
                             {{ $subcategory -> subcategory_name_en }}
                            @endif
                      </h2> <!-- SubCategory -->
                         </a>
                            
                            <!--   // Get SubSubCategory Table Data -->
                            @php
                              $subsubcategories = App\Models\SubSubCategory::where('subcategory_id',$subcategory->id)->orderBy('subsubcategory_name_en','ASC')->get();
                             @endphp    

                        @foreach($subsubcategories as $subsubcategory)
                                <ul class="links list-unstyled">
                                  <li><a href="{{ url('subsubcategory/product/'.$subsubcategory->id.'/'.$subsubcategory->subsubcategory_slug_en.'/'.$subsubcategory->subsubcategory_slug_ar ) }}">
                                   @if(session()->get('language') == 'arabic')
                                     {{ $subsubcategory->subsubcategory_name_ar }}
                                     @else
                                     {{ $subsubcategory->subsubcategory_name_en }}
                                   @endif
                                   </a>
                                 </li>
                              </ul>
                             @endforeach <!-- // End SubSubCategory Foreach -->

                      </div>

                      @endforeach <!-- End SubCategory Foreach -->



                    </div>
                    <!-- /.row --> 
                  </li>
                  <!-- /.yamm-content -->
                </ul>
                <!-- /.dropdown-menu --> </li>
              <!-- /.menu-item -->
              @endforeach <!-- End Category Foreach -->
              




              
              <li class="dropdown menu-item"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon fa fa-paper-plane"></i>Kids and Babies</a> 
                <!-- /.dropdown-menu --> </li>
              <!-- /.menu-item -->
              
              <li class="dropdown menu-item"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon fa fa-futbol-o"></i>Sports</a> 
                <!-- ================================== MEGAMENU VERTICAL ================================== --> 
                <!-- /.dropdown-menu --> 
                <!-- ================================== MEGAMENU VERTICAL ================================== --> </li>
              <!-- /.menu-item -->
              
              <li class="dropdown menu-item"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon fa fa-envira"></i>Home and Garden</a> 
                <!-- /.dropdown-menu --> </li>
              <!-- /.menu-item -->
              
            </ul>
            <!-- /.nav --> 
          </nav>
          <!-- /.megamenu-horizontal --> 
        </div>
        <!-- /.side-menu --> 