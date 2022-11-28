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
        'source' => 'string',
        'title' => 'string',
        'content' => 'string',
        'quote' => 'string',
        'author' => 'string',
        'editor' => 'string',
        'url' => 'string',
        'news_type' => 'string',
        'terminal_type' => 'string',
        'country' => 'string',
        'area' => 'string',
        'publish_time' => 'datetime',
        'create_time' => 'datetime',
        'update_time' => 'datetime',
    ];
}