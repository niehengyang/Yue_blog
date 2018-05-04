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
}
