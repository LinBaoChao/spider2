<?php

declare(strict_types=1);

namespace app\model;

use app\model\BaseModel;

/**
 * @mixin \think\Model
 */
class WebsiteField extends BaseModel
{
    // 设置字段信息
    protected $schema = [
        'id' => 'int',
        'parent_id' => 'int',
        'website_id' => 'int',
        'name' => 'string',
        'selector' => 'string',
        'selector_type' => 'string',
        'required' => 'int',
        'repeated' => 'int',
        'source_type' => 'string',
        'attached_url' => 'string',
        'is_write_db' => 'bool',
        'join_field' => 'string',
        'filter_type' => 'string',
        'filter' => 'string',
        'status' => 'int',
        'create_time' => 'datetime',
        'update_time' => 'datetime',
    ];

    public function website()
    {
        return $this->belongsTo(Website::class, 'website_id', 'id');
    }
}
