<?php

namespace App\Http\Controllers;

use App\Model\Article;
use App\Model\classification;
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
            return view('/welcome')->withErrors('暂无信息');
        }else{
            return view('/welcome',['articleList' =>$articleList]);
        }
    }

    public function about_page(){
        return view('/about');
    }

    public function contact_me(){
        return view('/contact');
    }

    public function Post_contact(){
        return view('/contact');
    }

}
