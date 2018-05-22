<?php

namespace App\Http\Controllers;

use App\Model\comments;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    public function store(){
        $input = Input::except('_token');
        $rules = [
            'email' =>'required',
            'comment_content' => 'required'
        ];
        $message = [
            'email.required' => '邮箱不能为空',
            'comment_content.required' => '评论不能为空',
        ];
        $validator  = Validator::make($input,$rules,$message);

        if ($validator->fails()){
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $comment = new comments();
        $comment->article_id = $input['article_id'];
        if (empty($input['user_id'])){
            $comment->user_id = 0;
        }else{
            $comment->user_id = $input['user_id'];
        }
        $comment->email = $input['email'];
        $comment->comment_content = $input['comment_content'];
        $comment->parent_id = $input['parent_id'];
        if ($comment->save()){
            return Redirect::back()->withErrors('提交成功')->withInput();
        }
        return Redirect::route('/article/show',[$comment->post->id,'#comment-input']);
    }

    public function destroy($id){
        $comment = comments::findOrFail($id);
        if (comments::destroy($id)){
            return Redirect::route('article_show',$comment->article_id);
        };
    }
}
