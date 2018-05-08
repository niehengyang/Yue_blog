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
            $content = $request->get('comment_content');
            if ($page > 1 && $content !=null ){
                $comments = comments::where('comment_content','like','%'.$content.'%')->paginate($perPage,'','',$page);
            }else{
                $comments =comments::where('comment_content','like','%'.$content.'%')->paginate($perPage);
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
                throw new Exception('无法禁用');
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
    public function createComments(Request $request){
        try{
            if (is_null($request->get('parent_id'))){
                $comment = new comments;
                $comment->article_id = $request->get('article_id');
                $comment->comment_content = $request->get('comment_content');
                $comment->release_size = $request->get('release_size');
                $comment->parent_id = $request->get('article_id');
                $comment->user_id = $request->get('user_id');
                if ($comment->save()){
                    return response('评论成功',200);
                }else{
                    throw new Exception('评论失败');
                }
            }else{
                $comment = new comments;
                $comment->article_id = $request->get('article_id');
                $comment->comment_content = $request->get('comment_content');
                $comment->release_size = $request->get('release_size');
                $comment->user_id = $request->get('user_id');
                $comment->parent_id = $request->get('parent_id');
                if ($comment->save()){
                    return response('评论成功',200);
                }else{
                    throw new Exception('评论失败');
                }
            }
        }catch (Exception $e){
            return response($e->getMessage(),500);
        }
    }
}
