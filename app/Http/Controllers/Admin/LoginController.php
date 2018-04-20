<?php

namespace App\Http\Controllers\Admin;

use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Mockery\Exception;

class LoginController extends Controller
{
    /**
        登录
     **/
    public function postLogin(Request $request){
        try{
            $adminLogin = $request->get('user');
            $adminPassword = $request->get('password');

            if(Auth::attempt(['user',$adminLogin,'password' => $adminPassword,'admin_status' =>1])){
                $admin =User::where('user',$adminLogin)->first();
                $admin->admin_lastloginip = $request->getClientIp();
                $admin->admin_lastlogintime =date("Y-m-d H:i:s");
                $admin->save();

                return response()->json([
                   'url' => '/home/'
                ]);
            }else{
                return response('用户名或密码错误！',400);
            }
        }catch (Exception $e){
            return response($e->getMessage(),500);
        }
    }

    /***
        退出登录
     ***/
    public function logout(Request $request){
        $user = $request->user();
        Auth::logout();
        return redirect('/admin/login');
    }

}
