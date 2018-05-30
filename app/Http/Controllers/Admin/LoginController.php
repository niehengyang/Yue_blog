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
               $user = Admin::where('account_number',$request->account_number)->first();
                $user->admin_lastloginip = $request->getClientIp();
                $user->admin_lastlogintime =date("Y-m-d H:i:s");
                $user->save();
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
    public function logout(){
        if(Auth::guard('admin')->user()){
            $this->guard()->logout();
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
            if ($request->isMethod('POST')){
                $validator = $this->validateRegister($request->input());
                if ($validator->fails()){
                    return back()->withErrors($validator)->withInput();
                }

                $user = new Admin();
                $user->name = $request->name;
                $user->account_number = $request->account_number;
                $user->password = bcrypt($request->password);
                $user->nickname = $request->nickname;
                $user->email = $request->email;
                if ($user->save()){
                    return Redirect::to('admin/login')->with('success','注册成功！');
                }else{
                    return back()->withErrors(['register_error' => '注册失败!'])->withInput();
                }
            }
        return view('admin.register');
    }

    protected function validateRegister(array $data){
        return Validator::make($data,[
            'name' => 'required|alpha_num|max:50',
            'account_number' => 'required|alpha_num|unique:admins|max:50',
            'password' => 'required|min:6|confirmed|max:64',
            'password_confirmation' => 'required|min:6|max:64',
            'nickname' => 'required|alpha_num|max:50',
            'email' => 'required|string|email|max:100|unique:users',
        ],[
            'required' => ':attribute 为必填项',
            'min' => ':attribute 长度不符合要求',
            'confirmed' => '两次输入密码不一致',
            'alpha_num' => ':attribute 必须为字母或数字',
            'max' => ':attribute 长度过长'
        ],[
            'name' => '姓名',
            'account_number' => '管理员账号',
            'password' => '密码',
            'password_confirmation' => '确认密码',
            'email' => '管理员邮箱',
            'nickname' => '昵称'
        ]);
    }

    /****
     忘记密码
     ***/
    public function passwordRequest(){

    }

}
