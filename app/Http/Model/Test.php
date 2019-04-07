<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $table = 'test';

    /**
     * 主键
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * 表明模型是否应该被打上时间戳
     *
     * @var bool
     */
    public $timestamps = false;


}
