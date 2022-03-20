<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Validator;

class OrderController extends Controller
{
    //
    public function orders(){
        return response()->json([
            'response'  => true,
            'data'      => Order::get()
        ], 200);
    }

    public function addorder(Request $request){
        $validation = Validator::make($request->all(), [
            'firstname'     => 'required|string',
            'lastname'      => 'required|string',
            'product'       => 'required',
            'quantity'      => 'required|numeric'
        ]);
        if($validation->fails()){
            return response()->json([
                'response'  => false,
                'message'   => $validation->messages()->first()
            ], 422);
        }
        Order::create([
            'customer_name'     => $request->firstname . ' ' . $request->lastname,
            'firstname'         => $request->firstname,
            'lastname'          => $request->lastname,
            'product_name'      => $request->product['product_name'],
            'manufacturer'      => $request->product['manufacturer'],
            'item_number'       => $request->product['item_no'],
            'total'             => $request->product['price'],
            'category_id'       => $request->product['category']['id'],
            'quantity'          => $request->quantity
        ]);

        return response()->json([
            'response'      => true
        ], 200);
    }

    public function deleteorder($id = null){
        Order::where('id', $id)->delete();
        return response()->json([
            'response'  => true
        ], 200);
    }
}
