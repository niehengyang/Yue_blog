<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function getuserinfo(Request $request){
        $user =$request->user();
        if (is_null($user)){
            return response('获取信息失败',500);
        }else{
            return response()->json($user);
        }
    }
    public function updateuserinfo(Request $request){

    }
}
