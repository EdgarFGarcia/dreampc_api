<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inventory;
use App\Models\Condition;
use Validator;

class InventoryController extends Controller
{
    //
    public function get(){
        return response()->json([
            'response'      => true,
            'data'          => Inventory::with('condition', 'category')->get(),
            'condition'     => Condition::get()
        ], 200);
    }

    public function getforder(){
        return response()->json([
            'response'  => true,
            'data'      => Inventory::with('condition', 'category')->where('quantity', '!=', 0)->get()
        ], 200);
    }

    public function addinventory(Request $request){
        $validation = Validator::make($request->all(), [
            'product_name'      => 'required|string',
            'item_no'           => 'required|string',
            'manufacturer'      => 'required|string',
            'price'             => 'required',
            'category_id'       => 'required',
            'condition_id'      => 'required',
            'quantity'          => 'required|numeric'
        ]);
        if($validation->fails()){
            return response()->json([
                'response'      => false,
                'message'       => $validation->messages()->first()
            ], 422);
        }

        Inventory::create($request->all());

        return response()->json([
            'response'  => true
        ], 200);

    }

    public function deleteinventory($id = null){
        Inventory::where('id', $id)->delete();
        return response()->json([
            'response'  => true
        ], 200);
    }

    public function addqty(Request $request, $id = null){
        Inventory::where('id', $id)->increment('quantity', $request->qty);

        return response()->json([
            'response'  => true
        ], 200);
    }
}
