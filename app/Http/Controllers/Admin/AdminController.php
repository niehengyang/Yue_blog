<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{

    protected function guard()
    {
        return auth()->guard('admin');
    }
    public function getuserinfo(Request $request)
    {
        $admin = Auth::guard('admin')->user();
        if (is_null($admin)) {
            return response('获取信息失败', 500);
        } else {
            return response()->json($admin);
        }
    }

    public function updateuserinfo(Request $request)
    {
        $admin = Auth::guard('admin')->user();
        if (is_null($admin)) {
            throw new Exception('用户不存在');
        }
        $admin->nickname = $request->get('nickname');
        $admin->name = $request->get('name');
        $admin->email = $request->get('email');
        if ($admin->save()) {
            return response('更新成功!', 200);
        } else {
            return response('更新失败!', 500);
        }
    }

    public function resetpwd(Request $request)
    {
        try {
            $admin= Auth::guard('admin')->user();
            if (is_null($admin)) {
                return response('用户不存在', 404);
            }
            if(Auth::guard('admin')->attempt(['password' => $request->get('admin_password')])){
                $admin->password = bcrypt($request->get('admin_newpassword'));
                $admin->save();
                return response('密码已重置，请重新登录！',200);
            }else{
                return response('密码错误',500);
            }
        } catch (Exception $e) {
            return response($e->getMessage(), 500);
        }
    }

}

