<?php

declare(strict_types=1);

namespace app\model;

use app\model\BaseModel;

/**
 * @mixin \think\Model
 */
class Menu extends BaseModel
{
    // 设置字段信息
    protected $schema = [
        'id' => 'int',
        'parent_id' => 'int',
        'menu_code' => 'string',
        'menu_name' => 'string',
        'icon' => 'string',
        'component' => 'string',
        'redirect' => 'string',
        'path' => 'string',
        'param_path' => 'string',
        'title' => 'string',
        'current_active_menu' => 'string',
        'ignore_keep_alive' => 'bool',
        'disabled' => 'bool',
        'show_menu' => 'bool',
        'hide_children_in_menu' => 'bool',
        'is_menu' => 'bool',
        'level' => 'int',
        'type' => 'int',
        'order_no' => 'int',
        'status' => 'int',
        'create_time' => 'datetime',
        'update_time' => 'datetime',
    ];
}
