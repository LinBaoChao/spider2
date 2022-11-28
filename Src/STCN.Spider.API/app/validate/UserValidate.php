<?php

declare(strict_types=1);

namespace app\validate;

use think\Validate;

class UserValidate extends Validate
{
    protected $rule =   [
        'id' => 'require',
        'userCode'  => 'require|max:50',
        'username'  => 'require|max:50',
        'password'   => 'require|min:8',
        'email' => 'email',
        'mobile' => 'mobile'
    ];

    protected $message  =   [
        'userCode.require' => '工号不能为空',
        'username.require' => '用户名不能为空',
        'password.require' => '密码不能为空',
        'password.min' => '密码长度不能小于8',
        'email'        => '邮箱格式错误',
        'mobile'        => '手机号格式错误',
    ];

    // 场景
    protected $scene = [
        'login'  =>  ['username', 'password.require'],
        'create'  =>  ['username','userCode', 'password','email','mobile'],
        'update'  =>  ['id','username', 'userCode', 'password', 'email', 'mobile'],
        'updatePassword'  =>  ['id', 'password'],
    ];
}