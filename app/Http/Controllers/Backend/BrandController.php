<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brnad;
use Image;


class BrandController extends Controller
{
    public function BrnadView(){
        $brands = Brnad::latest()->get();
        return view('backend.brand.brand_view',compact('brands'));
    }





    public function BrnadStore(Request $request){

       $request->validate([
        'brand_name_en' => 'required',
        'brand_name_ar' => 'required',
        'brnad_image' => 'required',
        ],[
            'brand_name_en.required' => 'Input Brand English Name',
            'brand_name_ar.required' => 'Input Brand Arabic Name',
        ]);


        $image = $request->file('brnad_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalName();
        Image::make($image)->resize(300,300)->save('upload/brand/'.$name_gen);
        $save_url = 'upload/brand/'.$name_gen;

        Brnad::insert([
            'brand_name_en' => $request->brand_name_en,
            'brand_name_ar' => $request->brand_name_ar,
            'brand_slug_en' => strtolower(str_replace(' ','-',$request->brand_name_en )), // NEW Brand -> new-brane
            'brand_slug_ar' => strtolower(str_replace(' ','-',$request->brand_name_ar)),
            'brnad_image' => $save_url,
        ]);


        $notification = array(
            'message' => 'Brand Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }// End Method



    public function BrnadEdit($id){
        $brand = Brnad::findOrFail($id); // findOrFail >> لو ما في نتيجة رجعت حيأدي لخطأ 
        return view('backend.brand.brand_edit',compact('brand'));
    } // End Method





    public function BrnadUpdate(Request $request){

        $brand_id = $request->id;
        $old_img = $request-> old_image;


        if($request->file('brnad_image')){

            unlink($old_img);
        $image = $request->file('brnad_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalName();
        Image::make($image)->resize(300,300)->save('upload/brand/'.$name_gen);
        $save_url = 'upload/brand/'.$name_gen;


        Brnad::findOrFail($brand_id)->update([
            'brand_name_en' => $request->brand_name_en,
            'brand_name_ar' => $request->brand_name_ar,
            'brand_slug_en' => strtolower(str_replace(' ','-',$request->brand_name_en )), // NEW Brand -> new-brane
            'brand_slug_ar' => strtolower(str_replace(' ','-',$request->brand_name_ar)),
            'brnad_image' => $save_url,
        ]);


        $notification = array(
            'message' => 'Brand Updated Successfully',
            'alert-type' => 'info'
        );

        return redirect()->route('all.brand')->with($notification);


        }else{

            Brnad::findOrFail($brand_id)->update([
                'brand_name_en' => $request->brand_name_en,
                'brand_name_ar' => $request->brand_name_ar,
                'brand_slug_en' => strtolower(str_replace(' ','-',$request->brand_name_en )), 
                'brand_slug_ar' => strtolower(str_replace(' ','-',$request->brand_name_ar)),
            ]);
    
    
            $notification = array(
                'message' => 'Brand Updated Successfully',
                'alert-type' => 'info'
            );
    
            return redirect()->route('all.brand')->with($notification);

        } // End else

    } // End Method


    public function BrnadDelete($id){
      $brand =  Brnad::findorFail($id);
      $img = $brand->brnad_image;
      unlink($img);

        Brnad::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Brand Delete Successfully',
            'alert-type' => 'info'
        );

        return redirect()->back()->with($notification);
    } // End Function 




}
