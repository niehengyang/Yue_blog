<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class comments extends Model
{
    protected $table = 'comments';
    protected $primaryKey = 'id';

    public function article(){
        return $this->belongsTo('App\Model\Article','article_id','id');
    }

    public function account(){
        return $this->belongsTo('App\Model\Account','user_id','id');
    }


    //数据层添加article_id,nickname,email字段并查找赋值
    protected $appends = ['article_title','nickname','email'];
    protected function getArticleTitleAttribute(){
        $articleId = $this->attributes['article_id'];
        if ($articleId){
            $article = Article::find($articleId);
            return $article->title;
        }else{
            return;
        }
    }
    protected function getNicknameAttribute(){
        $accountId = $this->attributes['user_id'];
        if ($accountId){
            $account = Account::find($accountId);
            return $account->nickname;
        }else{
            return;
        }
    }
    protected function getEmailAttribute(){
        $accountId = $this->attributes['user_id'];
        if ($accountId){
            $account = Account::find($accountId);
            return $account->email;
        }else{
            return;
        }
    }
}
