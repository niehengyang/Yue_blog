<?php

namespace App\Http\Controllers\Auth;

use App\Exceptions\AuthenticatesLogout;
use App\Http\Controllers\Controller;
use App\Model\Deskpageinfo;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers,AuthenticatesLogout{
        AuthenticatesLogout::logout insteadof AuthenticatesUsers;
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
        protected $redirectTo = '/';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function checkwebrelease_size(Request $request){
        $websitinfo = Deskpageinfo::find(1);
        return $websitinfo->web_release_size;
    }
}
