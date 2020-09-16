<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class MemberController extends Controller
{
    public function index(Request $request,$id = null)
    {
        if($id){
            $data = DB::table('member')->where('id_member','=',$id)->first();
            if($data){
                return response()->json([
                    'success' => true,
                    'message' => 'details data hass geted',
                    'data' => $data,
                ],200);
            }else{
                return response()->json([
                    'success' => false,
                    'message' => 'id not be found',
                    'data' => null,
                ],404);
            }
        }else{
            $data = DB::table('member')->get();
            if($data){
                return response()->json([
                    'success' => true,
                    'message' => 'data hass geted',
                    'data' => $data,
                ],200);
            }else{
                return response()->json([
                    'success' => false,
                    'message' => 'error ocureted',
                    'data' => null,
                ],500);
            }
        }
    }



    public function store(Request $request)
    {
        $id = DB::table('member')->max('id_member');
        $data = [
            'uniqid_member' =>  $id ? 'SN-'.date('Ymd').'-'.$id +=1 : 'SN'.date('Ymd').'-1',
            'nopol' => $request->nopol,
            'nra' => $request->nra,
            'full_name' => $request->full_name,
            'pseudonym' => $request->alias_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'alamat' => $request->alamat,
            'varian' => $request->varian,
            'warna' => $request->warna,
        ];
        $inserting = DB::table('member')->insert($data);
        if($inserting){
            return response()->json([
                'success' => true,
                'message' => 'data hass inserted',
                'data' => $data,
            ],200);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'error ocureted',
                'data' => null,
            ],500);
        }
    }


    public function update(Request $request,$id)
    {
        $data = [
            'nopol' => $request->nopol,
            'nra' => $request->nra,
            'full_name' => $request->full_name,
            'pseudonym' => $request->alias_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'alamat' => $request->alamat,
            'varian' => $request->varian,
            'warna' => $request->warna,
        ];
        $inserting = DB::table('member')->where('id_member','=',$id)->update($data);
        if($inserting){
            return response()->json([
                'success' => true,
                'message' => 'data hass updated',
                'data' => $data,
            ],200);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'error ocureted',
                'data' => null,
            ],500);
        }
    }

    public function destroy(Request $request,$id)
    {
        $delete = DB::table('member')->where('id_member','=',$id)->delete();
        if($delete){
            return response()->json([
                'success' => true,
                'message' => 'data hass success deleted !',
            ],200);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'error ocureted',
                'data' => null,
            ],500);
        }
    }
    
    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        $cek = DB::table('member')->where('email','=',$email)->first();
        if($cek->email == $email){
            if(Hash::check($password,$cek->password)){
                $apitoken = base64_encode(\Illuminate\Support\Str::random(32));
                DB::table('member')->where('email','=',$email)->update(['api_token' => $apitoken]);
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
