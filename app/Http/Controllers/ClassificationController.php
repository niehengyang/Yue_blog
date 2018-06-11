<?php

namespace App\Http\Controllers;

use App\Model\classification;
use App\Model\Article;
use Illuminate\Http\Request;

class ClassificationController extends Controller
{
    public function index(){
        $classifications = classification::all();
        $popular_article = $this->get_popularArticle();
        return view('classificationlist',['classifications' =>$classifications,'popular_articleList' => $popular_article]);
    }

    public function get_popularArticle(){
        $popular_article = Article::where('istop',1)->get();
        return $popular_article;
    }
}
