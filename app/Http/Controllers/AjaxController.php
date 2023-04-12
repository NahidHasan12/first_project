<?php

namespace App\Http\Controllers;

use App\Models\AjaxForm;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function test(request $request){
       // dd($request->all());

       return response()->json($request->data);

    }

    public function store(request $request){

        AjaxForm::create([
            'name'=>$request->name,
            'mail'=>$request->mail,
            'phone'=>$request->phone
        ]);

        return response()->json('Data Hase Been Saved Successfully');


    }
}
