<?php

namespace App\Http\Controllers\Admin;

use App\Model\Account;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class AccountController extends Controller
{
    public function getlist(Request $request){
        $perPage = $request->get('limit');
        $page = $request->get('page');
        if($page > 1 && $request->get('name') != null){
            $users = Account::where('name','like','%'.$request->get('name').'%')->paginate($perPage,'','',$page);
        }else {
            $users = Account::where('name', 'like', '%' . $request->get('name') . '%')->paginate($perPage);
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
        if($num = Account::destroy($userID)){
            return response('删除成功！',200);
        }else{
            return response('删除失败！',500);
        }
    }
}
