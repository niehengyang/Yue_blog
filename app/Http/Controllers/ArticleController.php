<?php

namespace App\Http\Controllers;

use App\Model\Article;
use App\Model\comments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    public function index(Request $request){
        $articleId = $request->input('id');
        $article_prev = Article::where('id','<',$articleId)->max('id');
        $prev_article_title = Article::find($article_prev)['title'];
        $article_next = Article::where('id','>',$articleId)->min('id');
        $next_article_title = Article::find($article_next)['title'];
        $currentUser = Auth::user();
        $comments = $this->getComments($articleId);
        if(Article::find($articleId)){
            $article = Article::find($articleId);
            return view('article',['article'=>$article,'prev_id'=>$article_prev,'next_id'=>$article_next,'prev_article_title'=>$prev_article_title,'next_article_title'=>$next_article_title,'currentUser' => $currentUser,'comments' =>$comments]);
        }
    }

    public function getComments($articleId){
        return comments::where('article_id',$articleId)->get();
    }

    public function getlist(Request $request){
        $classificationId = $request->input('id');
        $articleList = Article::where('classification_id',$classificationId)->get();
        if (is_null($articleList)){
            return view('/articlelist')->withErrors('暂无信息');
        }else{
            return view('/articlelist',['articleList' =>$articleList]);
        }
    }

}
