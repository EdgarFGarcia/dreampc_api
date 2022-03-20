<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth, Validator;

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
        }else{
            return response()->json([
                'response'  => false,
                'message'   => "Incorrect email or password. Or User does not exist"
            ], 422);
        }
    }

    public function register(Request $request){
        // return $request->all();
        $validation = Validator::make($request->all(),[
            'email'     => 'required|email|unique:users,email',
            'firstname' => 'required|string',
            'lastname'  => 'required|string',
            'mobile'    => 'required|numeric',
            'password'  => 'required|string'
        ]);
        if($validation->fails()){
            return response()->json([
                'response'  => false,
                'message'   => $validation->messages()->first()
            ], 422);
        }

        User::create([
            'name'              => $request->firstname . ' ' . $request->lastname,
            'firstname'         => $request->firstname,
            'lastname'          => $request->lastname,
            'mobilenumber'      => $request->mobile,
            'email'             => $request->email,
            'password'          => \Hash::make($request->password),
            'user_role'         => 2
        ]);

        return response()->json([
            'response'  => true,
            'message'   => 'Registration Successful'
        ], 200);
    }

    public function updateuser(Request $request, $id = null){
        $validation = Validator::make($request->all(), [
            'email'     => 'required|email|unique:users,email,'. $id,
            'firstname' => 'required|string',
            'lastname'  => 'required|string',
            'mobile'    => 'required|numeric'
        ]);
        if($validation->fails()){
            return response()->json([
                'response'  => false,
                'message'   => $validation->messages()->first()
            ], 422);
        }
        $udata = User::where('id', $id)->first();
        User::where('id', $id)
        ->update([
            'name'          => $request->firstname . ' ' . $request->lastname,
            'firstname'     => $request->firstname,
            'lastname'      => $request->lastname,
            'mobilenumber'  => $request->mobile,
            'email'         => $request->email,
            'password'      => $request->password == null ? $udata->password : \Hash::make($request->password)
        ]);

        return response()->json([
            'response'  => true,
            'message'   => 'Edit Profile Success'
        ], 200);
    }
}
