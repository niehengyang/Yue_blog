<?php

namespace App\Http\Controllers\Admin;

use App\Model\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mockery\Exception;
use Illuminate\Support\Facades\Storage;

class imageController extends Controller
{
    public function getimagelist(Request $request){
        try {
            $perPage = $request->get('limit');
            $page = $request->get('page');
            $title = $request->get('title');
            if ($page > 1 && $title !=null) {
                $articles = Article::where('title','like','%'.$title.'%')->paginate($perPage, '', '', $page);
            } else {
                $articles = Article::where('title','like','%'.$title.'%' )->paginate($perPage);
            }
            if (isEmpty($articles)) {
                return response('数据不存在', 500);
            } else {

                return response($articles, 200);
            }

        } catch (Exception $e) {
            return response($e->getMessage(), 500);
        }
    }

    public function replacepicture(Request $request){
        try{
            if (empty($request->get('article_id'))){
                throw new Exception('请重新选择修改！');
            }
            $articleId = $request->get('article_id');
            $articleImg = $request->get('url');
            $article = Article::find($articleId);
            if (is_null(  $request->get('name'))){
                $article->img = $articleImg;
                if($article->save()){
                    return response('修改成功',200);
                }else{
                    throw new Exception('修改失败！');
                }
            }else{
                if(Storage::disk('public')->delete($request->get('name'))){
                    $article->img = $articleImg;
                    if($article->save()){
                        return response('修改成功',200);
                    }else{
                        throw new Exception('修改失败！');
                    }
                }else{
                    throw new Exception('修改失败！');
                }
            }
        }catch (Exception $e ){
            return response($e->getMessage(),500);
        }
    }

    public function deletePicture(Request $request){
        try{
            if (is_null(  $request->get('name'))){
                throw new Exception('请重新选择删除！');
            }
            if (is_null($request->get('id'))){
                throw new Exception('请重新选择删除！');
            }
            $article = Article::find($request->get('id'));
            $article->img = null;
            if ($article->save()){
            if(Storage::disk('public')->delete($request->get('name'))){
                return response('删除成功！',200);
            }else{
                throw new Exception('删除失败！');
            }
            }
        }catch (Exception $e){
            return response($e->getMessage(),500);
        }
    }
}
