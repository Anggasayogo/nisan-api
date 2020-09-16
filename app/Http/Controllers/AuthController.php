<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $data = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ];

        $reqgister = DB::table('users')->insert($data);
        if($reqgister){
            return response()->json([
                'success' => true,
                'message' => 'data hass created',
                'data' => $data,
            ],201);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'error ocurreted',
                'data' => null,
            ],400);
        }
    }

    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        $cek = DB::table('users')->where('email','=',$email)->first();
        if($cek->email == $email){
            if(Hash::check($password,$cek->password)){
                $apitoken = base64_encode(\Illuminate\Support\Str::random(32));
                DB::table('users')->where('email','=',$email)->update(['api_token' => $apitoken]);
                return response()->json([
                    'success' => true,
                    'message' => 'login berhasil',
                    'api_token' => [
                        'user' => $cek,
                        'api_token' => $apitoken
                    ]
                ],201);
            }else{
                return response()->json([
                    'success' => false,
                    'message' => 'error ocurreted',
                    'data' => null,
                ],500);
            }
        }else{
            return response()->json([
                'success' => false,
                'message' => 'error ocurreted',
                'data' => null,
            ],500);
        }
    }


}
