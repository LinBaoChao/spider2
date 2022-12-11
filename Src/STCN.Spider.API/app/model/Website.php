<?php

declare(strict_types=1);

namespace app\model;

use app\model\BaseModel;

/**
 * @mixin \think\Model
 */
class Website extends BaseModel
{
    // 设置字段信息
    protected $schema = [
        'id' => 'int',
        'parent_id' => 'int',
        'media_name' => 'string',
        'product_name' => 'string',
        'platform' => 'string',
        'channel' => 'string',
        'name' => 'string',
        'domains' => 'string',
        'scan_urls' => 'string',
        'list_urls' => 'string',
        'content_urls' => 'string',
        'input_encoding' => 'string',
        'output_encoding' => 'string',
        'tasknum' => 'int',
        'multiserver' => 'bool',
        'serverid' => 'int',
        'save_running_state' => 'bool',
        'interval' => 'int',
        'timeout' => 'int',
        'max_try' => 'int',
        'max_depth' => 'int',
        'max_fields' => 'int',
        'user_agent' => 'string',
        'client_ip' => 'string',
        'proxy' => 'string',
        'status' => 'int',
        'create_time' => 'datetime',
        'update_time' => 'datetime',
    ];

    public function fields()
    {
        return $this->hasMany(WebsiteField::class, 'website_id', 'id');
    }
}