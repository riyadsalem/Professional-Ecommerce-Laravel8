<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Auth;
use App\Models\User;



class AdminProfileController extends Controller
{
    public function AdminProfile(){
        $id = Auth::user()->id;
        $adminData = Admin::find($id);
        return view('admin.admin_profile_view',compact('adminData'));

    }

    public function AdminProfileEdit(){
        $id = Auth::user()->id;
        $adminData = Admin::find($id);
        return view('admin.admin_profile_edit',compact('adminData'));
    }

    public function AdminProfileStore(Request $request){

        $id = Auth::user()->id;
        $data = Admin::find($id);
       // dd($data);
        $data->name = $request->name;
        $data->email = $request->email;

        if($request->file('profile_photo_path')){
            $file = $request->file('profile_photo_path');
            unlink(public_path('upload/admin_images/'.$data->profile_photo_path));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'),$filename);
            $data['profile_photo_path'] = $filename;
        }

        $data->save();



        $notification = array(
            'message' => 'Admin Profile Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.profile')->with($notification);


    } //end method



    public function AdminChangePassword(){
        
        return view('admin.admin_change_password');
    } //End Method

    
    public function AdminUpdateChangePassword(Request $request){
       $validateData = $request->validate([
           'oldpassword' => 'required',
           'password' => 'required|confirmed',
        ]);


        $hasshedPassword = Auth::user()->password;
        if(Hash::check($request->oldpassword,$hasshedPassword)){
            $admin = Admin::find(Auth::id());
            $admin->password = Hash::make($request->password);
            $admin->save();
            Auth::logout();
            return redirect()->route('admin.logout');
        }else{
            return redirect()->back();
        }


    } //END METHOD



    public function AllUsers(){

        $users = User::all();
        return view('backend.user.all_user',compact('users'));


    } // End Method




}
