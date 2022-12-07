<?php

declare(strict_types=1);

namespace app\model;

use app\model\BaseModel;

/**
 * @mixin \think\Model
 */
class Dept extends BaseModel
{
    // 设置字段信息
    protected $schema = [
        'id' => 'int',
        'parent_id' => 'int',
        'dept_name' => 'string',
        'desc' => 'string',
        'order_no' => 'int',
        'status' => 'int',
        'create_time' => 'datetime',
        'update_time' => 'datetime',
    ];
}
