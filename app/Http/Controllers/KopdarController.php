<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KopdarController extends Controller
{
    public function index(Request $request,$id = null)
    {
        if($id){
            $data = DB::table('kopdar')->where('id_kopdar','=',$id)->first();
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
            $kopdar = DB::table('kopdar')->get();
            if($kopdar){
                return response()->json([
                    'success' => true,
                    'message' => 'data hass geted',
                    'data' => $kopdar,
                ],200);
            }else{
                return response()->json([
                    'success' => false,
                    'message' => 'error ocureted !',
                    'data' => null,
                ],500);
            }
        }
    }

    public function store(Request $request)
    {
        $data = [
            'title_kopdar' => $request->title,
            'description_kopdar' => $request->description,
            'tujuan_lokasi' => $request->tujuan_lokasi
        ];

        $inserting = DB::table('kopdar')->insert($data);
        if($inserting){
            return response()->json([
                'success' => true,
                'message' => 'data hass geted',
                'data' => $data,
            ],201);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'error ocureted !',
                'data' => null,
            ],500);
        }
    }

    public function update(Request $request,$id)
    {
        $data = [
            'title_kopdar' => $request->title,
            'description_kopdar' => $request->description,
            'tujuan_lokasi' => $request->tujuan_lokasi
        ];

        $inserting = DB::table('kopdar')->where('id_kopdar','=',$id)->update($data);
        if($inserting){
            return response()->json([
                'success' => true,
                'message' => 'data hass updated',
                'data' => $data,
            ],201);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'error ocureted !',
                'data' => null,
            ],500);
        }
    }

    public function destroy(Request $request,$id)
    {
        $delete = DB::table('kopdar')->where('id_kopdar','=',$id)->delete();
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