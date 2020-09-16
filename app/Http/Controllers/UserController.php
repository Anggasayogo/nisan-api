<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request,$id)
    {
        $data = DB::table('users')->where('id','=',$id)->first();
        if($data){
            return response()->json([
                'success' => true,
                'message' => 'data hass geted',
                'data' => $data,
            ],200);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'data not be found',
                'data' => null,
            ],404);
        }
    }

}
