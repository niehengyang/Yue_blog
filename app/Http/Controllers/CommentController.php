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
            'comment_content' => 'required'
        ];
        $message = [
            'comment_content.required' => '评论不能为空',
        ];
        $validator  = Validator::make($input,$rules,$message);

        if ($validator->fails()){
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $comment = new comments();
        $comment->article_id = $input['article_id'];
        $comment->user_id = $input['user_id'];
        $comment->comment_content = $input['comment_content'];
        if ($comment->save()){
            return Redirect::back()->withErrors('提交成功')->withInput();
        }
        return Redirect::route('/article/show',[$comment->post->id,'#comment-input']);
    }
}
