<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $table = 'accounts';
    protected $primaryKey = 'id';

    public function comments(){
        return $this->hasMany('App\Model\comments','user_id','id');
    }
}
