<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\facades\Session;

class LanguageController extends Controller
{


    public function Arabic(){

        session()->get('language'); 
        session()->forget('language');
        Session::put('language','arabic'); // key => value
        return redirect()->back();


    }//End Methos



    public function English(){

        session()->get('language');
        session()->forget('language');
        Session::put('language','english');
        return redirect()->back();


    }//End Methos



}
