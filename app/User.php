<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    //1用户模型关联表
    public $table = 'blog_user';
//    2关联表的主键
    public $primaryKey = 'id';

    /**
     * 3允许被批量操作的字段
     *
     * @var array
     */
    protected $fillable = [
        'username', 'password',
    ];
    //禁用时间戳
    public $timestamps = false;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

}
