<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DonasiController extends Controller
{
    public function index(Request $request,$id = null)
    {
        if($id){
            $data = DB::table('donasi')->where('id_donasi','=',$id)->first();
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
            $data = DB::table('donasi')->get();
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
        $data = [
            'nama_korban' => $request->nama_korban,
            'alamat_korban' => $request->alamat_korban,
            'penyakit_yang_diderita' => $request->penyakit,
            'title_donasi' => $request->title,
            'description_donasi' => $request->decription,
        ];
        $insert = DB::table('donasi')->insert($data);
        if($insert){
            return response()->json([
                'success' => true,
                'message' => 'data hass inserted',
                'data' => $data,
            ],201);
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
            'nama_korban' => $request->nama_korban,
            'alamat_korban' => $request->alamat_korban,
            'penyakit_yang_diderita' => $request->penyakit,
            'title_donasi' => $request->title,
            'description_donasi' => $request->decription,
        ];
        $insert = DB::table('donasi')->where('id_donasi','=',$id)->update($data);
        if($insert){
            return response()->json([
                'success' => true,
                'message' => 'data hass updated',
                'data' => $data,
            ],201);
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
        $delete = DB::table('donasi')->where('id_donasi','=',$id)->delete();
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

}