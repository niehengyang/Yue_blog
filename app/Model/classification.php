<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class classification extends Model
{
    protected $table = 'classifications';
    protected $primaryKey = 'id';


    //关联关系一对多
    public function articles(){
        return $this->hasMany('App\Model\Article','classification_id','id');
    }


    protected $appends = ['articles_number'];

    protected function getArticlesNumberAttribute(){
        $classificationId = $this->attributes['id'] ;
        if ($classificationId){
            $articles_number = Article::where('classification_id',$classificationId)->count();
            return $articles_number;
        }else{
            return;
        }
    }
}
