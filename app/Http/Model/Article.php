<?php

namespace App\http\model;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table      = "article";
    protected $primaryKey = 'art_id';
    public    $timestamps = false;

    // protected $fillable=['cate_id','cate_name','cate_title','cate_keywords','cate_description','cate_view','cate_order','cate_pid']; //可以注入的数据字段
    protected $guarded=[]; //不可以注入的数据字段
}
