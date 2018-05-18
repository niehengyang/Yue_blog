<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'articles';
    protected $primaryKey = 'id';


    public function comments(){
        return $this->hasMany('App\Model\comments','article_id','id');
    }

    public function classification(){
        return $this->belongsTo('App\Model\classification','classification_id','id');
    }

    //数据层添加classification_name字段并查找赋值
    protected $appends = ['classification_name','comments_number','comments'];
    protected function getClassificationNameAttribute(){
        $classificationId = $this->attributes['classification_id'];
        if ($classificationId){
            $classification = classification::find($classificationId);
            return $classification['name'];
        }else{
            return;
        }
    }

    protected function getCommentsAttribute(){
    $articleId = $this->attributes['id'] ;
    if ($articleId){
        $comments = comments::where('article_id',$articleId);
        return ['comments'=>$comments];
    }else{
        return;
    }
}

    protected function getCommentsNumberAttribute(){
        $articleId = $this->attributes['id'] ;
        if ($articleId){
            $comments_number = comments::where('article_id',$articleId)->count();
            return $comments_number;
        }else{
            return;
        }
    }

}
