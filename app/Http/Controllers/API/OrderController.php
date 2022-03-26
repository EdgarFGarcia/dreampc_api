<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Inventory;
use Validator;

class OrderController extends Controller
{
    //
    public function orders(){
        return response()->json([
            'response'  => true,
            'data'      => Order::where('is_sold', 0)->where('is_cancel', 0)->get()
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

        // deduct quantity to invetory
        Inventory::where('id', $request->product['id'])->decrement('quantity', $request->quantity);

        $data = Order::create([
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
            'response'      => true,
            'data'          => Order::where('id', $data->id)->first()
        ], 200);
    }

    public function deleteorder($id = null){
        Order::where('id', $id)->delete();
        return response()->json([
            'response'  => true
        ], 200);
    }

    public function marksold($id = null){
        Order::where('id', $id)
        ->update([
            'is_sold'       => 1
        ]);
        return response()->json([
            'response'  => true
        ], 200);
    }

    public function markcancel($id = null, $pname = null){
        $data = Order::where('id', $id)->first();
        Inventory::where('product_name', $pname)->increment('quantity', $data->quantity);
        Order::where('id', $id)
        ->update([
            'is_cancel'     => 1
        ]);
        return response()->json([
            'response'  => true
        ], 200);
    }
}
