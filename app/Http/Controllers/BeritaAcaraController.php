<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BeritaAcaraController extends Controller
{
    public function index(Request $request,$id = null)
    {
        if($id){
            $data = DB::table('berita_acara_kasus')
                    ->join('member','berita_acara_kasus.id_member','=','member.id_member')
                    ->where('id_kasus','=',$id)->first();
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
            $data = DB::table('berita_acara_kasus')
                    ->join('member','berita_acara_kasus.id_member','=','member.id_member')
                    ->get();
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
            'id_member' => $request->id_member,
            'tanggal' => $request->tanggal,
            'deskripsi_kejadian' => $request->description,
        ];
        $insert = DB::table('berita_acara_kasus')->insert($data);
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
            'id_member' => $request->id_member,
            'tanggal' => $request->tanggal,
            'deskripsi_kejadian' => $request->description,
        ];
        $insert = DB::table('berita_acara_kasus')->where('id_kasus','=',$id)->update($data);
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
        $delete = DB::table('berita_acara_kasus')->where('id_kasus','=',$id)->delete();
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