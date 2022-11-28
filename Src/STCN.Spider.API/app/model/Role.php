<?php

declare(strict_types=1);

namespace app\model;

use app\model\BaseModel;

/**
 * @mixin \think\Model
 */
class Role extends BaseModel
{
    // 设置字段信息
    protected $schema = [
        'id' => 'int',
        'role_name' => 'string',
        'desc' => 'string',
        'status' => 'int',
        'order_no' => 'int',
        'create_time' => 'datetime',
        'update_time' => 'datetime',
    ];

    public function menus()
    {
        return $this->belongsToMany(Menu::class, RoleMenu::class, 'menu_id', 'role_id');
    }
}