<?php

namespace App\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    //指定允许批量赋值的字段
    protected $fillable = [
        'name','account_number','password','email','nickname'
    ];

    //表名
    protected $table = 'admins';

    //指定键名
    protected $primaryKey = 'adminid';



    //自动维护时间戳
//    public $timestamps = false;

    //定制维护时间戳
//    protected $dateFormat = 'U';

    //将默认增加时间转化为时间戳
//    protected function getDateFormat()
//    {
//        return time();
//    }

    protected $hidden = [
        'password','remember_token'
    ];
}
