<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function ajax_form(){
        return view('ajax_form');
    }

    public function ajax(Request $request)
    {
       return response()->json(['result'=>$request->file]);
    }
}
