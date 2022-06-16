<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Category;
use App\Models\Slider;
use App\Models\Product;
use App\Models\MultiImg;
use App\Models\Brnad;
use App\Models\BlogPost;
use App\Models\SubCategory;
use App\Models\SubSubCategory;










class IndexController extends Controller
{
    public function index(){

        $categories = Category::orderBy('category_name_en','ASC')->get();
        $sliders = Slider::where('status',1)->orderBy('id','DESC')->limit(3)->get();
    	$products = Product::where('status',1)->orderBy('id','DESC')->limit(6)->get();
        $featured = Product::where('featured',1)->orderBy('id','DESC')->limit(6)->get();
        $hot_Deals = Product::where([ ['hot_deals',1] , ['discount_price','!=',Null] ] )->orderBy('id','DESC')->limit(6)->get();
        $special_offer = Product::where('special_offer',1)->orderBy('id','DESC')->limit(6)->get();
        $special_deals = Product::where('special_deals',1)->orderBy('id','DESC')->limit(3)->get();

        //$skip_category_0 = Category::findOrFail(20);
        $skip_category_0 = Category::skip(0)->first();
       // return $skip_category -> id;
       // die();
       $skip_product_0 = Product::where('status',1)->where('category_id', $skip_category_0->id)->orderBy('id','DESC')->get();


       $skip_category_4 = Category::skip(4)->first(); 
       $skip_product_4 = Product::where([['status',1],['category_id',$skip_category_4->id]])->orderBy('id','DESC')->get();


       $skip_brand_5 = Brnad::skip(5)->first(); 
       $skip_product_5 = Product::where([['status',1],['brand_id',$skip_brand_5->id]])->orderBy('id','DESC')->get();

       $blogpost = BlogPost::latest()->get();


    	return view('frontend.index',compact('categories','sliders','products','featured','hot_Deals','special_offer','special_deals','skip_category_0','skip_product_0','skip_category_4','skip_product_4','skip_brand_5','skip_product_5','blogpost'));
    }


    public function UserLogout(){
       Auth::logout();
       return Redirect()->route('login');

    }

    public function UserProfile(){
        $id = Auth::user()->id;
        $user = User::find($id);
        return view('frontend.profile.user_profile',compact('user'));

    }


    public function UserProfileStore(Request $request){
        $data = User::find(Auth::user()->id);
         $data->name = $request->name;
         $data->email = $request->email;
         $data->phone = $request->phone;

 
         if($request->file('profile_photo_path')){
             $file = $request->file('profile_photo_path');
             // unlink(public_path('upload/admin_images/'.$data->profile_photo_path));
             $filename = date('YmdHi').$file->getClientOriginalName();
             $file->move(public_path('upload/user_images'),$filename);
             $data['profile_photo_path'] = $filename;
         }
 
         $data->save();
 
 
         $notification = array(
             'message' => 'User Profile Updated Successfully',
             'alert-type' => 'success'
         );
 
         return redirect()->route('dashboard')->with($notification); 

    } // End Method


    public function UserChangePassword(){
        $user = User::find(Auth::user()->id);
        return view('frontend.profile.change_password',compact('user'));
        
    }



    public function UserPasswordUpdate(Request $request){
        $validateData = $request->validate([
            'oldpassword' => 'required',
            'password' => 'required|confirmed',
         ]);
 
 
         $hasshedPassword = Auth::user()->password;
         if(Hash::check($request->oldpassword,$hasshedPassword)){
             $user = User::find(Auth::id());
             $user->password = Hash::make($request->password);
             $user->save();
             Auth::logout();
             return redirect()->route('user.logout');
         }else{
             return redirect()->back();
         }
 
 
     } //END METHOD





     public function ProductDetails($id,$slug){

        $product = Product::findOrFail($id);

        $color_en = $product -> product_color_en;
        $product_color_en = explode(',', $color_en);

        
        $color_ar = $product -> product_color_ar;
        $product_color_ar = explode(',', $color_ar);

        
        $size_en = $product -> product_size_en;
        $product_size_en = explode(',', $size_en);

        
        $size_ar = $product -> product_size_ar;
        $product_size_ar = explode(',', $size_ar);

        $cat_id = $product -> category_id;
        $relatedProduct = Product::where('category_id',$cat_id)->where('id','!=',$id)->orderBy('id','DESC')->get();


        $multiImg = MultiImg::where('product_id',$id)->get();

        return view('Frontend.product.product_details',compact('product','multiImg','product_color_en','product_color_ar','product_size_en','product_size_ar','relatedProduct'));


     }// End Mehtod






     public function TagWaseProduct($tag){

         $products = Product::where([ ['status',1], ['product_tags_en', $tag], ['product_tags_ar', $tag] ])
         ->orderBy('id','DESC')->get();
         $categories = Category::orderBy('category_name_en','ASC')->get();

         return view('frontend.tags.tags_view',compact('products','categories'));
     } // End Mehtod



     public function SubCatWaseProduct(Request $request, $subcat_id , $slug){

        $products = Product::where([ ['status',1], ['subcategory_id', $subcat_id] ])->orderBy('id','DESC')->paginate(3);   
        $categories = Category::orderBy('category_name_en','ASC')->get();
        $breadsubcat = SubCategory::with(['category'])->where('id',$subcat_id)->get();


        if($request->ajax()){
            $grid_view = view('frontend.product.grid_view_product',compact('products'))->render();
            $list_view = view('frontend.product.list_view_product',compact('products'))->render();
            return response()->json([
                'grid_view' => $grid_view,
                'list_view',$list_view
            ]);
        }


        return view('frontend.product.subcategory_view',compact('products','categories','breadsubcat'));


     }// End Method
     



     public function SubSubCatWaseProduct($subsubcat_id , $slug_en , $slug_ar){

        $products = Product::where([ ['status',1], ['subsubcategory_id', $subsubcat_id] ])->orderBy('id','DESC')->get();   
        $categories = Category::orderBy('category_name_en','ASC')->get();
        $breadsubsubcat = SubSubCategory::with(['category','subcategory'])->where('id',$subsubcat_id)->get();
        return view('frontend.product.sub_subcategory_view',compact('products','categories','breadsubsubcat'));


     } //End Method



    /// Product View With Ajax
	public function ProductViewAjax($id){
		$product = Product::with('category','brand')->findOrFail($id);

		$color = $product->product_color_en;
		$product_color = explode(',', $color);

		$size = $product->product_size_en;
		$product_size = explode(',', $size);

		return response()->json(array(
			'product' => $product,
			'color' => $product_color,
			'size' => $product_size,

		));

	} // end method 



         // Product Seach 
    public function ProductSearch(Request $request){

         $request->validate(["search" => "required"]);

         $item = $request->search;
         // echo "$item";
         $categories = Category::orderBy('category_name_en','ASC')->get();
         $products = Product::where('product_name_en','LIKE',"%$item%")->get();
         return view('frontend.product.search',compact('products','categories'));
    } // End Method


    // Advance Search Options
    public function SearchProduct(Request $request){
    
        $request->validate(["search" => "required"]);

        $item = $request->search;
        
        $products = Product::where('product_name_en','LIKE',"%$item%")->select('product_name_en','product_thambnail','id','selling_price','product_slug_en')->limit(5)->get();
        return view('frontend.product.search_product',compact('products'));

    } // End Method


}
