<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table      = "category";
    protected $primaryKey = 'cate_id';
    public    $timestamps = false;

    // protected $fillable=['cate_id','cate_name','cate_title','cate_keywords','cate_description','cate_view','cate_order','cate_pid']; //可以注入的数据字段
    protected $guarded=[]; //不可以注入的数据字段


    /**
     * @return array
     */
    public function tree()
    {
        // $categorys = $this->all();
        // 根据 cate_order 倒序
        $categorys = $this->orderBy('cate_order', 'desc')->get();
        return $this->getTree($categorys, 'cate_name', 'cate_id', 'cate_pid', 0);
    }

    /**
     * @param $data
     * @param string $field_name
     * @param string $field_id
     * @param string $field_pid
     * @param int $pid_value
     * @return array
     */
    public function getTree($data, $field_name = 'cate_name', $field_id = 'id', $field_pid = 'pid', $pid_value = 0)
    {
        $arr = [];
        foreach ($data as $k => $v) {
            if ($v->$field_pid == $pid_value) {
                // var_dump($v->cate_name);
                $data[$k]['_' . $field_name] = $data[$k][$field_name];
                $arr[]                       = $data[$k];
                foreach ($data as $m => $n) {
                    if ($n->$field_pid == $v->$field_id) {
                        $data[$m]['_' . $field_name] = '├─' . $data[$m][$field_name];
                        $arr[]                       = $data[$m];
                    }
                }
            }
        }
        return $arr;
    }

}
