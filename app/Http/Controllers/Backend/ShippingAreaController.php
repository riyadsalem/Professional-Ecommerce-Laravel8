<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ShipDivision;
use Carbon\Carbon;
use App\Models\ShipDistrict;
use App\Models\ShipState;



class ShippingAreaController extends Controller
{
    
    public function DivisionView(){

        $divisions = ShipDivision::orderBy('id','DESC')->get();
        return view('backend.ship.division.view_division',compact('divisions'));
        
    } // End Method


    public function DivisionStore(Request $request){

        $request->validate([
            'division_name' => 'required',
        ]);

        ShipDivision::insert([
            'division_name' => $request->division_name,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Division Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);   


    } // End Method




    public function DivisionEdite($id){

        $divisions = ShipDivision::findOrFail($id);
        return view('backend.ship.division.edit_division',compact('divisions'));

    } // End Method



    public function DivisionUpdate(Request $request , $id){

        $request->validate([
            'division_name' => 'required',
        ]);

        ShipDivision::findOrFail($id)->update([
            'division_name' => $request->division_name,
        ]);

        $notification = array(
            'message' => 'Division Updated Successfully',
            'alert-type' => 'info'
        );

        return redirect()->route('manage-division')->with($notification);  
    }




    public function DivisionDelete($id){

        ShipDivision::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Division Deleted Successfully',
            'alert-type' => 'info'
        );

        return redirect()->back()->with($notification);  

    } // End Methos



  //////////////////////////// Ship District: Start ////////////////////////////

    public function DistrictView(){

        $divisions = ShipDivision::orderBy('division_name','ASC')->get();
        $district = ShipDistrict::with('division')->orderBy('id','DESC')->get();
        return view('backend.ship.distric.view_district',compact('district','divisions'));

    } // End Method



    public function DistrictStore(Request $request){

        $request->validate([
            'division_id' => 'required',
            'district_name' => 'required'
        ]);


        ShipDistrict::insert([
            'division_id' =>  $request -> division_id,
            'district_name' => $request -> district_name ,
            'created_at' => Carbon::now(),

        ]);


        $notification = array(
            'message' => 'District inserted Successfully',
            'alert-type' => 'successs'
        );

        return redirect()->back()->with($notification);  

    } // End Method



    public function DistrictEdite($id){

        $divisions = ShipDivision::orderBy('division_name','ASC')->get();
        $district = ShipDistrict::findOrFail($id);
        return view('backend.ship.distric.edit_district',compact('district','divisions'));

    } // End Method



    public function DistrictUpdate(Request $request, $id){

       $districtIdUpdate = ShipDistrict::findOrFail($id);
       $districtIdUpdate -> division_id =  $request -> division_id;
       $districtIdUpdate -> district_name = $request -> district_name ;
       $districtIdUpdate->save();

        $notification = array(
            'message' => 'District Updated Successfully',
            'alert-type' => 'info'
        );

        return redirect()->route('manage-District')->with($notification);  


    } // End Function



    public function DistrictDelete($id){

        ShipDistrict::findOrFail($id)->delete();

        $notification = array(
            'message' => 'District Deleted Successfully',
            'alert-type' => 'warning'
        );

        return redirect()->back()->with($notification);  

    } // End Function


  //////////////////////////// Ship District: End ////////////////////////////





    //////////////////////////// Ship State: End ////////////////////////////

    public function StateView(){

        $divisions = ShipDivision::orderBy('division_name','ASC')->get();
        $district = ShipDistrict::orderBy('district_name','ASC')->get();
        $state = ShipState::with('division','district')->orderBy('id','DESC')->get();
        return view('backend.ship.state.view_state',compact('district','divisions','state'));

    } // End Method



    public function StateStore(Request $request){

        $request->validate([
            'division_id' => 'required',
            'district_id' => 'required',
            'state_name' => 'required',
        ]);

        ShipState::insert([
            'division_id' => $request->division_id,
            'district_id' => $request->district_id,
            'state_name' => $request->state_name,
            'created_at' => Carbon::now()
        ]);


        $notification = array(
            'message' => 'State Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);  

    } // End Method



    public function StateEdite($id){

        $divisions = ShipDivision::orderBy('division_name','ASC')->get();
        $district = ShipDistrict::orderBy('district_name','ASC')->get();
        $state = ShipState::findOrFail($id);
        return view('backend.ship.state.edit_state',compact('district','divisions','state'));

    } // End Method




    public function StateUpdate(Request $request, $id){


        ShipState::findOrFail($id)->update([
            'division_id' => $request->division_id,
            'district_id' => $request->district_id,
            'state_name' => $request->state_name,
        ]);

        $notification = array(
            'message' => 'State Updated Successfully',
            'alert-type' => 'info'
        );

        return redirect()->route('manage-State')->with($notification);  

    } // End Method



    public function StateDelete($id){

        ShipState::findOrFail($id)->delete();

        $notification = array(
            'message' => 'State Deleted Successfully',
            'alert-type' => 'warning'
        );

        return redirect()->back()->with($notification);  


    } // End Method










    //////////////////////////// Ship State: End ////////////////////////////




}
