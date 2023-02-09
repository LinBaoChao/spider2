<?php
require_once __DIR__ . '/../extend/topspider/autoloader.php';
use topspider\core\topspider;
use topspider\core\selector;
use topspider\core\website;
use topspider\core\log;
use topspider\core\util;
function on_extract_page_qizhiwangorg($page, $fields)
{
    if (!isset($fields['source_name']) || empty($fields['source_name'])) {
        if (isset($fields['source']) && !empty($fields['source'])) {
            $fields['source_name'] = $fields['source'];
        }
    }

    return $fields;
}