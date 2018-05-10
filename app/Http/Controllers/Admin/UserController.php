<?php

namespace App\Http\Controllers\Admin;

use App\Model\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function getuserinfo(Request $request)
    {
        $user = Auth::guard('admin')->user();
        if (is_null($user)) {
            return response('获取信息失败', 500);
        } else {
            return response()->json($user);
        }
    }

    public function updateuserinfo(Request $request)
    {
        $userId = $request->get('id');
        $user = Admin::find($userId);
        if (is_null($user)) {
            throw new Exception('用户不存在');
        }
        $user->nickname = $request->get('nickname');
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        if ($user->save()) {
            return response('更新成功!', 200);
        } else {
            return response('更新失败!', 500);
        }
    }

    public function resetpwd(Request $request)
    {
        try {
            $adminId = $request->get('id', false);
            $adminPassword = $request->get('admin_password');
            if (false === $adminId) {
                return response('参数错误', 500);
            }
            $admin = Admin::find($adminId);
            if (is_null($admin)) {
                return response('用户不存在', 404);
            }
            if(Auth::attempt(['password' => $adminPassword])){
                $admin->password = bcrypt($request->get('admin_newpassword'));
                $admin->save();
                return response('密码重置成功',200);
            }else{
                return response('密码错误',500);
            }
        } catch (Exception $e) {
            return response($e->getMessage(), 500);
        }
    }
}

