<?php

namespace App\Http\Controllers\Admin;

use App\Model\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mockery\Exception;

class ArticleController extends Controller
{
    public function index(Request $request){
        try{
            $perPage = $request->get('limit');
            $page = $request->get('page');
            $title = $request->get('title');
            if ($page > 1 && $title !=null ){
                $articles = Article::where('title','like','%'.$title.'%')->paginate($perPage,'','',$page);
            }else{
                $articles =Article::where('title','like','%'.$title.'%')->paginate($perPage);
            }
            if (is_null($articles)){
                return response('数据不存在',500);
            }else{
                return response($articles,200);
            }

        }catch (Exception $e){
            return response($e->getMessage(),500);
        }
    }

    public function delarticle(Request $request){
        try{
            $ids = $request->get('id');
            if($ids == 0){
                throw new Exception('不能删除根!');
            }
            if($num = Article::destroy($ids)){
                return response('删除成功！',200);
            }else{
                throw new Exception('删除失败！');
            }
        }catch (Exception $e){
            return response($e->getMessage(),500);
        }
    }
    public function store(Request $request){
        try{
            if(is_null($request->get('id'))){
                $article = new Article;
            $article->title = $request->get('title');
            $article->content = $request->get('content');
            $article->release_size = $request->get('release_size');
            $article->img = $request->get('img');
            $article->abstract = $request->get('abstract');
//              $article->draft_style = $request->get('draft_style');
            $article->classification = $request->get('classification');
//              $article->reading_quantity = $request->get('reading_quantity');
            $article->author = $request->get('author');
            $article->istop = $request->get('istop');
                if ($article->save()){
                    return response('创建成功!',200);
                 }else{
                    throw new Exception('创建失败！');
                 }
            }else{
                $article = Article::find($request->get('id'));
                if (is_null($article)) {
                    return response('文章不存在',404);
                }
                $article->title = $request->get('title');
                $article->content = $request->get('content');
                $article->release_size = $request->get('release_size');
                $article->img = $request->get('img');
                $article->abstract = $request->get('abstract');
//              $article->draft_style = $request->get('draft_style');
                $article->classification = $request->get('classification');
//              $article->reading_quantity = $request->get('reading_quantity');
                $article->author = $request->get('author');
                $article->istop = $request->get('istop');
                if ($article->save()){
                    return response('修改成功!',200);
                }else{
                    throw new Exception('修改失败！');
                }
            }
        }catch (Exception $e){
            return response($e->getMessage(),500);
        }
    }

    public function createnewarticle($articleData){
        try{

    }catch ( Exception $e){
            return response($e->getMessage(),500);
        }
    }
}
