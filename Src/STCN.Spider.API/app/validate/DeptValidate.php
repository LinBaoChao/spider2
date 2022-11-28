<?php

declare(strict_types=1);

namespace app\validate;

use think\Validate;

class DeptValidate extends Validate
{
    protected $rule =   [
        'id' => 'require',
        'deptName'  => 'require|max:50',
        'status'   => 'require',
    ];

    protected $message  =   [
        'id.require' => 'id不能为空',
        'deptName.require' => '部门名不能为空',
        'deptName.max' => '部门名长度不能大于50',
        'status.require'        => '状态不能为空',
    ];

    // 场景
    protected $scene = [
        'create'  =>  ['deptName', 'status'],
        'update'  =>  ['id', 'deptName', 'status'],
    ];
}