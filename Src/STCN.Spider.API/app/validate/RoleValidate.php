<?php

declare(strict_types=1);

namespace app\validate;

use think\Validate;

class RoleValidate extends Validate
{
    protected $rule =   [
        'id' => 'require',
        'roleName'  => 'require|max:50',
        'status'   => 'require',
    ];

    protected $message  =   [
        'id.require' => 'id不能为空',
        'roleName.require' => '角色名不能为空',
        'roleName.max' => '角色名长度不能大于50',
        'status.require'        => '状态不能为空',
    ];

    // 场景
    protected $scene = [
        'create'  =>  ['roleName', 'status'],
        'update'  =>  ['id','roleName', 'status'],
    ];
}