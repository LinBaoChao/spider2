<?php

declare(strict_types=1);

namespace app\validate;

use think\Validate;

class WebsiteFieldValidate extends Validate
{
    protected $rule =   [
        'id' => 'require',
        'websiteId'  => 'require',
        'fieldName'  => 'require|max:50',
        'selector'  => 'require|max:200',
    ];

    protected $message  =   [
        'id.require' => 'id不能为空',
        'websiteId.require' => '网站Id不能为空',
        'fieldName.require' => '名称不能为空',
        'selector.require' => '获取规则不能为空',

        'fieldName.max' => '名称长度不能大于50',
        'selector.max' => '获取规则长度不能大于200',
    ];

    // 场景
    protected $scene = [
        'create'  =>  ['websiteId', 'fieldName', 'selector'],
        'update'  =>  ['id', 'websiteId', 'fieldName', 'selector'],
    ];
}
