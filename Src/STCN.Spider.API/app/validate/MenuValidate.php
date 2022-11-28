<?php

declare(strict_types=1);

namespace app\validate;

use think\Validate;

class MenuValidate extends Validate
{
    protected $rule =   [
        'id' => 'require',
        'title'  => 'require|max:50',
        'permission'  => 'require|max:50',
        'status'   => 'require',
    ];

    protected $message  =   [
        'id.require' => 'id不能为空',
        'menuName.require' => '功能名称不能为空',
        'title.require' => '显示名称不能为空',
        'title.max' => '显示名称长度不能大于50',
        'permission.require' => '权限标识不能为空',
        'permission.max' => '权限标识长度不能大于50',
        'status.require'        => '状态不能为空',
    ];

    // 场景
    protected $scene = [
        'create'  =>  ['title', 'permission', 'status'],
        'update'  =>  ['id','title', 'permission', 'status'],
    ];
}