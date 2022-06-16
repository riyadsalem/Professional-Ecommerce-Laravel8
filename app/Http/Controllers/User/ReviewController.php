<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
use Auth;
use Carbon\Carbon;

class ReviewController extends Controller
{

    public function ReviewStore(Request $reqeust){

        $product = $reqeust->product_id;

        $reqeust->validate([
            'summary' => 'required',
            'comment' => 'required',
        ]);

        Review::insert([
            'product_id' => $product,
            'user_id' => Auth::id(),
            'comment' => $reqeust->comment,
            'summary' => $reqeust->summary,
            'rating' => $reqeust->quality,
            'created_at' => Carbon::now(),
        ]);


        $notification = array(
            'message' => 'Review Will Approve By Admin',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);  


    } // End Method


    public function PendingReview(){

        $review = Review::with('user','product')->where('status', 0)->orderBy('id','DESC')->get();
        return view('backend.review.pending_review',compact('review'));
    
    } // End Method


    public function ReviewAprove($id){


        Review::where('id',$id)->update(['status' => 1]);


        $notification = array(
            'message' => 'Review Approve Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('publish.review')->with($notification);  

    } // End Method


    public function PublishReview(){

        $review = Review::where('status',1)->orderBy('id','DESC')->get();
        return view('backend.review.publish_review',compact('review'));

    } // End Mehtod

    public function deleteReview($id){

        Review::findOrFail($id)->delete();


        $notification = array(
            'message' => 'Review Delete Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);  


    } // End Method

}
