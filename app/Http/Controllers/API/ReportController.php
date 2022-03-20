<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class ReportController extends Controller
{
    //
    public function sales(){
        return response()->json([
            'response'  => true,
            'data'      => Order::withTrashed()->orderBy('created_at')->get()
        ], 200);
    }
}
