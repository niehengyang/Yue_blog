<?php

namespace App\Http\Controllers;

use App\Model\Article;
use App\Model\Deskpageinfo;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articleList = Article::paginate(8);
        if (is_null($articleList)){
            return view('/home')->withErrors('暂无信息');
        }else{
            return view('/home',['articleList' =>$articleList]);
        }
    }

}
