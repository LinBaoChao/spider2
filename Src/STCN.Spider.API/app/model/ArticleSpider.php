<?php

declare(strict_types=1);

namespace app\model;

use app\model\BaseModel;

/**
 * @mixin \think\Model
 */
class ArticleSpider extends BaseModel
{
    // 设置字段信息
    protected $schema = [
        'id' => 'int',
        'source_name' => 'string',
        'source_media_name' => 'string',
        'source_product_name' => 'string',
        'source_platform_name' => 'string',
        'source_channel_name' => 'string',
        'source_title' => 'string',
        'source_content' => 'string',
        'source_author' => 'string',
        'source_url' => 'string',
        'pub_source_name' => 'string',
        'pub_media_name' => 'string',
        'pub_product_name' => 'string',
        'pub_platform_name' => 'string',
        'pub_channel_name' => 'string',
        'status' => 'int',
        'source_pub_time' => 'datetime',
        'create_time' => 'datetime',
        'update_time' => 'datetime',
    ];
}
