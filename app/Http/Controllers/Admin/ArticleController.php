<?php

namespace App\Http\Controllers\Admin;

use App\Model\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mockery\Exception;
use Illuminate\Support\Facades\Storage;

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
            if($request->get('id') == 0 || $request->get('id') == null){
                $article = new Article;
                $article->title = $request->get('title');
                $article->slug = $request->get('slug');
                $article->content = $request->get('content');
                $article->release_size = $request->get('release_size');
                $article->img = $request->get('img');
                $article->abstract = $request->get('abstract');
                $article->classification = $request->get('classification');
                $article->author = $request->get('author');
                $article->istop = $request->get('istop');
                if ($article->save()){
                    return response('创建成功!',200);
                }else{
                    throw new Exception('创建失败！');
                }
            }else{
                $article = Article::find($request->get('id'));
                if (is_null($article)){
                    throw new Exception('文章不存在');
                }
                $article->title = $request->get('title');
                $article->slug = $request->get('slug');
                $article->content = $request->get('content');
                $article->release_size = $request->get('release_size');
                $article->img = $request->get('img');
                $article->abstract = $request->get('abstract');
                $article->classification = $request->get('classification');
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
    public function upload(Request $request){
        if ($request->hasFile('file') && $request->file('file')->isValid()){
            $photo = $request->file('file');
            $extension = $photo->extension();
            $ext = $photo->getClientOriginalExtension();//文件扩展名
            $filename = date('Y-m-d-H-i-s').'.'.$ext;//文件重命名
            $store_result = $photo->storeAs('public',$filename);
            $originalName = $photo->getClientOriginalName();//文件原名
            $realPath = $photo->getRealPath();
//            $type = $photo->getClientMimeType();//image/jpg
            $url = Storage::url($store_result);//获取当前路径
            $output = [
                'extension' => $extension,
                'store_result' => $store_result,
                'realPath' => $realPath,
                'originalName' =>$originalName,
                'url' => $url,
                'filename' => $filename,
            ];
            return response()->json($output);
        }else{
            return response('上传失败',500);
        }

    }
}
