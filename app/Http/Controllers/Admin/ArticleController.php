<?php

namespace App\Http\Controllers\Admin;


use App\Model\Account;
use App\Model\Article;
use App\Model\comments;
use App\Providers\RouteServiceProvider;
use DeepCopy\f001\A;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mockery\Exception;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        try {
            $perPage = $request->get('limit');
            $page = $request->get('page');
            $title = $request->get('title');
            if ($page > 1 && $title != null) {
                $articles = Article::where('title', 'like', '%' . $title . '%')->paginate($perPage, '', '', $page);
            } else {
                $articles = Article::where('title', 'like', '%' . $title . '%')->paginate($perPage);
            }
            if (is_null($articles)) {
                return response('数据不存在', 500);
            } else {
                return response($articles, 200);
            }

        } catch (Exception $e) {
            return response($e->getMessage(), 500);
        }
    }

    public function delarticle(Request $request)
    {
        try {
            $ids = $request->get('id');
            $imgs = $request->get('img');
            if ($ids == 0) {
                throw new Exception('不能删除根!');
            }
            if (is_null($imgs)) {
                if (Article::destroy($ids)) {
                    return response('删除成功！', 200);
                } else {
                    throw new Exception('删除失败！');
                }
            }
            //删除文章同时删除图片和评论
            if (Article::destroy($ids) && Storage::disk('public')->delete($imgs)) {
                return response('删除成功！', 200);
            } else {
                throw new Exception('删除失败！');
            }
        } catch (Exception $e) {
            return response($e->getMessage(), 500);
        }
    }

    public function store(Request $request)
    {
        try {
            if ($request->get('id') == 0 || $request->get('id') == null) {
                $istopnum = Article::where('istop', true)->count();
                if ($request->get('istop') && $istopnum >= 3) {
                    throw new Exception('置顶个数已达最大值！');
                }
                $article = new Article;
                $article->title = $request->get('title');
                $article->slug = $request->get('slug');
                $article->content = $request->get('content');
                $article->release_size = $request->get('release_size');
                $article->img = $request->get('img');
                if (is_null($request->get('abstract'))) {
                    $text = $request->get('content');
                    $article->abstract = $this->Generate_Brief($text,BRIEF_LENGTH);
                } else {
                    $article->abstract = $request->get('abstract');
                }
                $article->classification_id = $request->get('classification_id');
                $article->author = $request->get('author');
                $article->istop = $request->get('istop');
                if ($article->save()) {
                    return response('创建成功!', 200);
                } else {
                    throw new Exception('创建失败！');
                }
            } else {
                $istopnum = Article::where('istop', true)->count();
                if ($request->get('istop') && $istopnum >= 3) {
                    throw new Exception('置顶个数已达最大值！');
                }
                $article = Article::find($request->get('id'));
                if (is_null($article)) {
                    throw new Exception('文章不存在');
                }
                $article->title = $request->get('title');
                $article->slug = $request->get('slug');
                $article->content = $request->get('content');
                $article->release_size = $request->get('release_size');
                $article->img = $request->get('img');
                if (is_null($request->get('abstract'))) {
                    $article->abstract = $this->Generate_Brief($request->get('content'));
                } else {
                    $article->abstract = $request->get('abstract');
                }
                $article->classification_id = $request->get('classification_id');
                $article->author = $request->get('author');
                $article->istop = $request->get('istop');
                if ($article->save()) {
                    return response('修改成功!', 200);
                } else {
                    throw new Exception('修改失败！');
                }
            }
        } catch (Exception $e) {
            return response($e->getMessage(), 500);
        }
    }

    /**
     * 自动提取文章摘要
     **/
    function Generate_Brief($text){
        mb_regex_encoding("UTF-8");
        if(mb_strlen($text) <= BRIEF_LENGTH ) return $text;
//        去掉转义和html标签
        $newContent = strip_tags(stripslashes($text));
//        取掉两边多余的空格
        $newContent = trim($newContent);
        $patternArr = array('/\s/','/ /');
        $replaceArr = array('','');
        $newContent = preg_replace($patternArr,$replaceArr,$newContent);
//        截取固定的长度
        return $newContent = mb_strcut($newContent,0,BRIEF_LENGTH,'utf-8').'...';
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
    public function published(Request $request){
        try{
            if(is_null($request->get('id'))){
                throw new Exception('请重新选择');
            }else{
                $articleId = $request->get('id');
                if (is_null(Article::find($articleId))){
                    throw new Exception('数据不存在');
                }else{
                    $articleinfo = Article::find($articleId);
                    if($articleinfo->release_size == 1){
                        throw new Exception('该文章已经发布');
                    }
                    $articleinfo->release_size = 1;
                    if ($articleinfo->save()){
                        return response('发表成功!',200);
                    }else{
                        throw new Exception('发表失败！');
                    }
                }
            }
        }catch ( Exception $e){
            return response($e->getMessage(),500);
        }
    }

    public function deletePicture(Request $request){
        try{
            if (is_null(  $request->get('name'))){
                throw new Exception('请重新选择删除！');
            }
            if(Storage::disk('public')->delete($request->get('name'))){
                return response('删除成功！',200);
            }else{
                throw new Exception('删除失败！');
            }
        }catch (Exception $e){
            return response($e->getMessage(),500);
        }
    }
}
