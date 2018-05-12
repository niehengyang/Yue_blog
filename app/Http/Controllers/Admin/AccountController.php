<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Mockery\Exception;

class AccountController extends Controller
{
    public function getList(Request $request){
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
    public function deleteAccount(Request $request){
        try{
        $userID = $request->get('id');
        if(is_null($userID)){
            throw new Exception('信息获取失败请重新选择删除！');
        }
        if(User::destroy($userID)){
            return response('删除成功！',200);
        }else{
            throw new Exception('删除失败！');
        }
        }catch (Exception $e){
            return response($e->getMessage(),500);
        }
    }

}
