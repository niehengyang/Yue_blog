<?php

namespace App\Http\Controllers;

use App\Model\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(Request $request){
        $articleId = $request->input('id');
        $article_prev = Article::where('id','<',$articleId)->max('id');
        $article_next = Article::where('id','>',$articleId)->min('id');
        if(Article::find($articleId)){
            $article = Article::find($articleId);
            return view('article',['article'=>$article,'prev_id'=>$article_prev,'next_id'=>$article_next]);
        }
    }

}
