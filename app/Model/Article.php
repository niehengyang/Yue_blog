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
}
