<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use App\Models\Brnad;
use App\Models\Product;
use Carbon\Carbon;
use Image;
use App\Models\MultiImg;



class ProductController extends Controller
{



    public function AddProduct(){
        $categories = Category::latest()->get();
        $brands = Brnad::latest()->get();
        return view('backend.product.product_add',compact('categories','brands'));
    } // End Method



    public function StoreProduct(Request $request){


        $request->validate([
            'file' => 'required|mimes:jpeg,png,jpg,zip,pdf,xlx,csv|max:2048',
        ]);

        if($files = $request->file('file')){
            $destinationPath = 'upload/pdf';
            $digitalItem = date('YmdHis').".".$files->getClientOriginalName();
            $files->move($destinationPath,$digitalItem);            
        }


        $image = $request->file('product_thambnail');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalName();
        Image::make($image)->resize(917,1000)->save('upload/products/thambnail/'.$name_gen);
        $save_url = 'upload/products/thambnail/'.$name_gen;        


       $product_id = Product::insertGetId([
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'subsubcategory_id' => $request->subsubcategory_id,
            'product_name_en' => $request->product_name_en,
            'product_name_ar' => $request->product_name_ar,

            'product_slug_en' => strtolower(str_replace(' ','-',$request->product_name_en)),
            'product_slug_ar' => strtolower(str_replace(' ','-',$request->product_name_ar)),

            'product_code' => $request->product_code,
            'product_qty' => $request->product_qty,
            'product_tags_en' => $request->product_tags_en,
            'product_tags_ar' => $request->product_tags_ar,
            'product_size_en' => $request->product_size_en,
            'product_size_ar' => $request->product_size_ar,
            'product_color_en' => $request->product_color_en,
            'product_color_ar' => $request->product_color_ar,
            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'short_descp_en' => $request->short_descp_en,
            'short_descp_ar' => $request->short_descp_ar,
            'long_descp_en' => $request->long_descp_en,
            'long_descp_ar' => $request->long_descp_ar,

            'product_thambnail' => $save_url,

            'hot_deals' => $request->hot_deals,
            'featured' => $request->featured,
            'special_offer' => $request->special_offer,
            'special_deals' => $request->special_deals,
            'digital_file' => $digitalItem,
            
            'status' => 1,
            'created_at' => Carbon::now(),


        ]);


        //////////////////////////// Multiple Image Upload Start ////////////////////////////

        $images = $request->file('multi_img');
        foreach($images as $img){
        $make_name = hexdec(uniqid()).'.'.$img->getClientOriginalName();
        Image::make($img)->resize(917,1000)->save('upload/products/multi-image/'.$make_name);
        $uploadPath = 'upload/products/multi-image/'.$make_name; 


        MultiImg::insert([

            'product_id'=> $product_id,
            'photo_name'=> $uploadPath,
            'created_at' => Carbon::now(),

        ]);

        }   
    
        //////////////////////////// Multiple Image Upload End ////////////////////////////

        
        $notification = array(
            'message' => 'Product Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('manage-product')->with($notification);

    

    } // End Method




    public function ManageProduct(){

        $products = Product::latest()->get();
        return view('backend.product.product_view',compact('products'));
    } // End Method


    public function EditProduct($id){

        $brands = Brnad::latest()->get();
        $categories = Category::latest()->get();
        $subcategory = SubCategory::latest()->get();
        $subsubcategory = SubSubCategory::latest()->get();
        $products = Product::findOrfail($id);
        $multiImgs = MultiImg::where('product_id',$id)->get();
        return view('backend.product.product_edit',compact('brands','categories','subcategory','subsubcategory','products','multiImgs'));
    } // End Method



    public function ProductDataUpdate(Request $request){

        $product_id = $request -> id;

        Product::findOrfail($product_id)->update([
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'subsubcategory_id' => $request->subsubcategory_id,
            'product_name_en' => $request->product_name_en,
            'product_name_ar' => $request->product_name_ar,

            'product_slug_en' => strtolower(str_replace('','-',$request->product_name_en)),
            'product_slug_ar' => strtolower(str_replace('','-',$request->product_name_ar)),

            'product_code' => $request->product_code,
            'product_qty' => $request->product_qty,
            'product_tags_en' => $request->product_tags_en,
            'product_tags_ar' => $request->product_tags_ar,
            'product_size_en' => $request->product_size_en,
            'product_size_ar' => $request->product_size_ar,
            'product_color_en' => $request->product_color_en,
            'product_color_ar' => $request->product_color_ar,
            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'short_descp_en' => $request->short_descp_en,
            'short_descp_ar' => $request->short_descp_ar,
            'long_descp_en' => $request->long_descp_en,
            'long_descp_ar' => $request->long_descp_ar,

        //    'product_thambnail' => $save_url,

            'hot_deals' => $request->hot_deals,
            'featured' => $request->featured,
            'special_offer' => $request->special_offer,
            'special_deals' => $request->special_deals,
            
            'status' => 1,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Product Updated Without Image Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('manage-product')->with($notification);


    } // End Function 




    // Mutiple Image Update
    public function MultiImageUpdate(Request $request){
		$imgs = $request->multi_img;

		foreach ($imgs as $id => $img) {
	    $imgDel = MultiImg::findOrFail($id);
	    unlink($imgDel->photo_name);

    	$make_name = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
    	Image::make($img)->resize(917,1000)->save('upload/products/multi-image/'.$make_name);
    	$uploadPath = 'upload/products/multi-image/'.$make_name;

    	MultiImg::where('id',$id)->update([
    		'photo_name' => $uploadPath,
    		'updated_at' => Carbon::now(),

    	]);

	 } // end foreach

       $notification = array(
			'message' => 'Product Image Updated Successfully',
			'alert-type' => 'info'
		);

		return redirect()->back()->with($notification);

	} // end mehtod 



    // Product Main Thambnail Update
    public function ThambnailiImageUpdate(Request $request){

        $pro_id = $request -> id; 
        $oldImage = $request -> old_img;
	    unlink($oldImage);

        $image = $request->file('product_thambnail');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalName();
        Image::make($image)->resize(917,1000)->save('upload/products/thambnail/'.$name_gen);
        $save_url = 'upload/products/thambnail/'.$name_gen;    

    	Product::findOrFail($pro_id)->update([
    		'product_thambnail' => $save_url,
    		'updated_at' => Carbon::now(),
    	]);


       $notification = array(
			'message' => 'Product Image Thambnail Updated Successfully',
			'alert-type' => 'info'
		);

		return redirect()->back()->with($notification);


    } // End Method




    // Multi Image Delete
    public function MultiImagDelete($id){

       $oldimg =  MultiImg::findOrFail($id);
       unlink($oldimg->photo_name);

        MultiImg::findOrFail($id)->delete();
        
        $notification = array(
			'message' => 'Product Image Deleted Successfully',
			'alert-type' => 'success'
		);

		return redirect()->back()->with($notification);


    } // End Method





    // Add Multi Image at Edit Page
    public function AddMultiImageProduct(Request $request){

        $product_id = $request -> id; 

        $images = $request->file('multi_img');
        foreach($images as  $img) {

        $make_name = hexdec(uniqid()).'.'.$img->getClientOriginalName();
        Image::make($img)->resize(917,1000)->save('upload/products/multi-image/'.$make_name);
        $uploadPath = 'upload/products/multi-image/'.$make_name; 


        MultiImg::insert([

            'product_id'=> $product_id,
            'photo_name'=> $uploadPath,
            'created_at' => Carbon::now(),

        ]);
    }

        $notification = array(
			'message' => 'Product  Image Add Successfully',
			'alert-type' => 'success'
		);

		return redirect()->back()->with($notification);


    } // End Method



    public function ProductInactive($id){

        Product::findOrFail($id)->update([ 'status' => 0 ]);

        $notification = array(
			'message' => 'Product Inactiv Successfully',
			'alert-type' => 'success'
		);

		return redirect()->back()->with($notification);

    } // End Method


    
    public function ProductActive($id){

        Product::findOrFail($id)->update([ 'status' => 1 ]);


        $notification = array(
			'message' => 'Product Inactiv Successfully',
			'alert-type' => 'success'
		);

		return redirect()->back()->with($notification);

    } // End Method





    public function ProductDelete($id){

        $product = Product::findOrFail($id);
        unlink($product->product_thambnail);
        Product::findOrFail($id)->delete();

              
      $images =  MultiImg::where('product_id',$id)->get();
      foreach($images as $img){
          unlink($img->photo_name);
          MultiImg::where('product_id',$id)->delete();
      }

        $notification = array(
			'message' => 'Product Deleted Successfully',
			'alert-type' => 'success'
		);

		return redirect()->back()->with($notification);


    } // End Method

   
    
    // Product Stock
    public function ProductStock(){

        $products = Product::latest()->get();
        return view('backend.product.product_stock',compact('products'));

    } // End Method



}
