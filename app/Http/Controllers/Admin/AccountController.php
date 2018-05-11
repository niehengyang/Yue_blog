<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class AccountController extends Controller
{
    public function getlist(Request $request){
        $perPage = $request->get('limit');
        $page = $request->get('page');
        if($page > 1 && $request->get('nickname') != null){
            $users = User::where('nickname','like','%'.$request->get('nickname').'%')->paginate($perPage,'','',$page);
        }else {
            $users = User::where('nickname', 'like', '%' . $request->get('nickname') . '%')->paginate($perPage);
        }
        if (is_null($users)){
            return response('数据不存在',500);
        }else{
            return response($users,200);
        }
    }
    public function deleteaccount(Request $request){
        $userID = $request->get('id');
        if(is_null($userID)){
            throw new Exception('删除失败！');
        }
        if($num = User::destroy($userID)){
            return response('删除成功！',200);
        }else{
            return response('删除失败！',500);
        }
    }
}
