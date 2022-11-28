<?php

declare(strict_types=1);

namespace app\model;

use app\model\BaseModel;

/**
 * @mixin \think\Model
 */
class User extends BaseModel
{
    // protected $autoWriteTimestamp = 'datetime'; // 已在database配置文件中全局开启

    // 设置字段信息
    protected $schema = [
        'id' => 'int',
        'user_code' => 'string',
        'username' => 'string',
        'real_name' => 'string',
        'nickname' => 'string',
        'password' => 'string',
        'salt' => 'string',
        'gender' => 'string',
        'avatar' => 'string',
        'desc' => 'string',
        'wechat_id' => 'string',
        'email' => 'string',
        'mobile' => 'string',
        'job' => 'string',
        'order_no' => 'int',
        'status' => 'int',
        'birthday' => 'datetime',
        'login_time' => 'datetime',
        'effective_time' => 'datetime',
        'create_time' => 'datetime',
        'update_time' => 'datetime',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class, UserRole::class, 'role_id', 'user_id');
    }

    public function depts()
    {
        return $this->belongsToMany(Dept::class, UserDept::class, 'dept_id', 'user_id');
    }
}