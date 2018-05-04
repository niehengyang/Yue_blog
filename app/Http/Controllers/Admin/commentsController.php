<?php

namespace App\Http\Controllers\Admin;

use App\Model\comments;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mockery\Exception;

class commentsController extends Controller
{
    public function getcommentslist(Request $request){
        try{
            $perPage = $request->get('limit');
            $page = $request->get('page');
            $title = $request->get('article_title');
            if ($page > 1 && $title !=null ){
                $comments = comments::where('article_title','like','%'.$title.'%')->paginate($perPage,'','',$page);
            }else{
                $comments =comments::where('article_title','like','%'.$title.'%')->paginate($perPage);
            }
            if (is_null($comments)){
                return response('数据不存在',500);
            }else{
                return response($comments,200);
            }
        }catch (Exception $e){
            return response($e->getMessage(),500);
        }
    }

    public function disableFun(Request $request){
        try{
            $commentsId = $request->get('id');
            if ($commentsId == 0 ){
                throw new Exception('删除出错');
            }
            if (is_null($commentsId)){
                throw new Exception('请重新选择');
            }
            $comments = comments::find($commentsId);
            if (is_null($comments)){
                throw new Exception('该评论不存在');
            }
            $comments ->release_size = $request->get('release_size');
            if ($comments->save()){
                return response('禁用成功',200);
            }else{
                throw new Exception('禁用失败');
            }
        }catch (Exception $e){
            return response($e->getMessage(),500);
        }
    }
    public function delcomments(Request $request) {
        try{
            $commentsId = $request->get('id');
            if ($commentsId == 0 ){
                throw new Exception('删除出错');
            }
            if (is_null($commentsId)){
                throw new Exception('请重新选择');
            }
            if (comments::destroy($commentsId)){
                return response('删除成功',200);
            }else{
                throw new Exception('删除失败');
            }
        }catch (Exception $e){
            return response($e->getMessage(),500);
        }
    }
}
