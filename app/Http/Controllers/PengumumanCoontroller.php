<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengumumanController extends Controller
{
    public function index(Request $request,$id = null)
    {
        if($id){
            $data = DB::table('pengumuman')->where('id_pengumuman','=',$id)->first();
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
            $data = DB::table('pengumuman')->get();
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
}