<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    /**
     * 自定义更新时间字段名
     */
    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'update_time';

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
     * 表名模型是否应该被打上时间戳
     *
     * @var bool
     */
    /*public $timestamps = false;*/

    /**
     * 模型日期列的存储格式
     *
     * @var string
     */
    protected $dateFormat = 'U';


}
