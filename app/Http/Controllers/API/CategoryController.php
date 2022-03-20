<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Validator;

class CategoryController extends Controller
{
    //
    public function get(){
        return response()->json([
            'response'  => true,
            'data'      => Category::get()
        ], 200);
    }

    public function addcategory(Request $request){
        $validation = Validator::make($request->all(), [
            'name'      => 'required|unique:categories,name'
        ]);
        
        if($validation->fails()){
            return response()->json([
                'response'  => false,
                'message'   => $validation->messages()->first()
            ], 422);
        }

        Category::create([
            'name'      => $request->name
        ]);

        return response()->json([
            'response'  => true
        ], 200);

    }
}
