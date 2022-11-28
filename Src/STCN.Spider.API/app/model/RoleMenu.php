<?php

declare(strict_types=1);

namespace app\model;

use think\model\Pivot;

/**
 * @mixin \think\Model
 */
class RoleMenu extends Pivot
{
    protected $autoWriteTimestamp = true;

    // protected $pk = 'permission_code';

    // 设置字段信息
    protected $schema = [
        'id' => 'int',
        'menu_id' => 'int',
        'role_id' => 'int',
        'create_time' => 'datetime',
        'update_time' => 'datetime',
    ];
}