<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class AuthenticationController extends Controller
{
    //
    public function login(Request $request){
        $credentials = [];
        if(filter_var($request->username, FILTER_VALIDATE_EMAIL)){
            $credentials = [
                'email'     => $request->username,
                'password'  => $request->password
            ];
        }else{
            $credentials = [
                'username'  => $request->username,
                'password'  => $request->password
            ];
        }
        $data = Auth::attempt($credentials);
        if($data){
            $token = $request->user()->createToken(Auth::user()->name);
            return response()->json([
                'response'  => true,
                'udata'     => Auth::user(),
                'data'      => $token->plainTextToken
            ], 200);
        }
    }
}
