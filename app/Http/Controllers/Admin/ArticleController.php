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
}
