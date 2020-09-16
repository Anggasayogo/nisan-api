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

    public function store(Request $request)
    {
        if($request->hasFile('gambar')){
            $original_filename = $request->file('gambar')->getClientOriginalName();
            $original_filename_arr = explode('.', $original_filename);
            $file_ext = end($original_filename_arr);
            $destination_path = './pengumuman/gambar';
            $image = time() . '.' . $file_ext;
            if($request->file('gambar')->move($destination_path, $image)){
                $data= [
                    'title' => $request->title,
                    'description' => $request->description,
                    'gambar' => url().'/pengumuan/gambar/'.$image,
                    'post_by' => $request->post_by,
                ];
                $insert = DB::table('pengumuman')->insert($data);
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
        }
    }
    public function update(Request $request,$id)
    {
        if($request->hasFile('gambar')){
            $original_filename = $request->file('gambar')->getClientOriginalName();
            $original_filename_arr = explode('.', $original_filename);
            $file_ext = end($original_filename_arr);
            $destination_path = './pengumuman/gambar';
            $image = time() . '.' . $file_ext;
            if($request->file('gambar')->move($destination_path, $image)){
                $data= [
                    'title' => $request->title,
                    'description' => $request->description,
                    'gambar' => url().'/pengumuan/gambar/'.$image,
                    'post_by' => $request->post_by,
                ];
                $insert = DB::table('pengumuman')->where('id_pengumuman','=',$id)->update($data);
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
        }else{
            $img = DB::table('pengumuman')->where('id_pengumuman','=',$id)->first();
            $data= [
                'title' => $request->title,
                'description' => $request->description,
                'gambar' => $img->gambar,
                'post_by' => $request->post_by,
            ];
            $insert = DB::table('pengumuman')->where('id_pengumuman','=',$id)->update($data);
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
    }

    public function destroy(Request $request,$id)
    {
        $delete = DB::table('pengumuman')->where('id_kpengumuman','=',$id)->delete();
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