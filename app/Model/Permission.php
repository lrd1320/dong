<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    //关联数据表
    public $table = 'permission';

    //主键
    public $primaryKey = 'id';

    //允许批量操作的字段

//    public $fillable = ['user_name','user_pass','email'];
    public $guarded = [];

    //是否维护crated_at 和 updated_at 字段
    public $timestamps = false;
}
