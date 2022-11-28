<?php

declare(strict_types=1);

namespace app\model;

use think\Model;

class BaseModel extends Model
{
    // protected $autoWriteTimestamp = 'datetime'; 已在database配置文件中全局开启

    // 数据转换为驼峰命名
    protected $convertNameToCamel = true;
}