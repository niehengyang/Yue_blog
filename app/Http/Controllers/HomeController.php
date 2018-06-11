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
        $popular_article = $this->get_popularArticle();
        if (is_null($articleList)){
            return view('/welcome')->withErrors('暂无信息');
        }else{
            return view('/welcome',['articleList' =>$articleList,'popular_articleList' => $popular_article]);
        }
    }

    public function tryPage(){
        return view('/welcome');
    }

    public function get_popularArticle(){
        $popular_article = Article::where('istop',1)->get();
        return $popular_article;
    }
}
