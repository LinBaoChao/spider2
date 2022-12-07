<?php

declare(strict_types=1);

namespace app\validate;

use think\Validate;

class WebsiteValidate extends Validate
{
    protected $rule =   [
        'id' => 'require',
        'name'  => 'require|max:50',
        'mediaName'  => 'require|max:50',
        'domains'  => 'require|max:200',
        'scanUrls'  => 'require|max:200',
        'listUrls'  => 'require|max:500',
        'contentUrls'  => 'require|max:500',
    ];

    protected $message  =   [
        'id.require' => 'id不能为空',
        'name.require' => '媒体名称不能为空',
        'mediaName.require' => '媒体名称不能为空',
        'domains.require' => '域名不能为空',
        'scanUrls.require' => '入口页Url不能为空',
        'listUrls.require' => '列表页Url不能为空',
        'contentUrls.require' => '内容页Url不能为空',

        'name.max' => '媒体名称长度不能大于50',
        'mediaName.max' => '媒体名称长度不能大于50',
        'domains.max' => '域名长度不能大于200',
        'scanUrls.max' => '入口页Url长度不能大于200',
        'listUrls.max' => '列表页Url长度不能大于500',
        'contentUrls.max' => '内容页Url长度不能大于500',
    ];

    // 场景
    protected $scene = [
        'create'  =>  ['name', 'mediaName', 'domains', 'scanUrls', 'listUrls', 'contentUrls'],
        'update'  =>  ['id', 'name', 'mediaName', 'domains', 'scanUrls', 'listUrls', 'contentUrls'],
    ];
}
