<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\AuthenticatesLogout;
use App\Model\Admin;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Mockery\Exception;

class LoginController extends Controller
{

    use AuthenticatesUsers,AuthenticatesLogout{
        AuthenticatesLogout::logout insteadof  AuthenticatesUsers;
    }

    protected $redirectTo = 'admin/';
    protected $guard = 'admin';
    protected $username;
//    protected $loginView = 'admin.login';
//    protected $registerView = 'admin.register';

    public function __construct()
    {
        $this->middleware('guest.admin:admin',['except' => 'logout']);
        $this->username = config('admin.global.username');
    }

    //show admin login model
    public function showLoginForm()
    {
        return view('admin.login');
    }

    //use admin guard
    protected function guard()
    {
        return auth()->guard('admin');
    }

    public function username()
    {
        return 'account_number';
    }

    /**
        登录
     **/

    public function postLogin(Request $request){
        if($request->isMethod('POST')){
            $validator = $this->validateLogin($request->input());
            if ($validator->fails()){
                return back()->withErrors($validator)->withInput();
            }
            if (Auth::guard('admin')->attempt(['account_number' =>$request->account_number,'password' =>$request->password])){
                return Redirect::to('admin/')->with('success','登录成功!');
            }else{
                return back()->withErrors(['login_error' => '账号或密码错误'])->withInput();
            }
        }
        return view('admin.login');
    }
    //登录页面验证
    protected function validateLogin(array $data)
    {
        return Validator::make($data ,[
            'account_number' => 'required|alpha_num',
            'password' => 'required'
        ],[
            'required' => ':attribute 为必填项',
            'min' => ':attribute 长度不符合要求'
        ],[
            'account_number' => '账号',
            'password' => '密码'
        ]);
    }

    /***
        退出登录
     ***/
    public function logout(Request $request){
        if(Auth::guard('admin')->user()){
            Auth::guard('admin')->logout();
            return response('已退出',200);
        }else{
            return response('注销出错！',500);
        }
        return Redirect::to('admin/login');
    }

    /****
        注册
     ***/
    public function getRegister(){
        return view('admin.register');
    }
    public function register(Request $request){
        try{
            if ($request->isMethod('post')){
                $validator = $this->validateRegister($request->input());
                if ($validator->fails()){
                    return back()->withErrors($validator)->withInput();
                }

                $user = new Admin();
                $user->name = $request->get('name');
                $user->account_number = $request->get('account_number');
                $user->password = bcrypt($request->get('password'));
                $user->admin_lastloginip = $request->getClientIp();
                $user->admin_lastlogintime =date("Y-m-d H:i:s");
                if ($user->save()){
                    return response('注册成功！',200);
                }else{
                    throw new Exception('注册失败!');
                }
            }
        }catch (Exception $e){
            return response($e->getMessage(),500);
        }
    }

    protected function validateRegister(array $data){
        return Validator::make($data,[
            'name' => 'required|alpha_num|max:255',
            'account_number' => 'required|alpha_num|unique:admins',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6'
        ],[
            'required' => ':attribute 为必填项',
            'min' => ':attribute 长度不符合要求',
            'confirmed' => '两次输入密码不一致',
            'alpha_num' => ':attribute 必须为字母或数字',
            'max' => ':attribute 长度过长'
        ],[
            'name' => '昵称',
            'account_number' => '账号',
            'password' => '密码',
            'password_confirmation' => '确认密码'
        ]);
    }


}
