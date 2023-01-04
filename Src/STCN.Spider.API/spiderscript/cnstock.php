<?php
require_once __DIR__ . '/../extend/phpspider/autoloader.php';
use phpspider\core\phpspider;
use phpspider\core\selector;
use phpspider\core\website;
use phpspider\core\log;
use phpspider\core\util;
function on_start_cnstock($spider)
{
    // log::add("on_start_cnstock","script");
    // 把列表页重新加入增量更新抓取，这样不会排重url
    foreach ($spider::$configs['list_url_regexes'] as $url) {
        $spider->add_scan_url($url);
    }
}

function on_extract_field_cnstock($fieldname, $data, $page)
{
    // log::add("on_extract_field_cnstock".$data,"script");

    if ($fieldname == 'source_author') {
        $data = str_replace("作者：", "", $data);
    } elseif ($fieldname == 'source_name') {
        $data = str_replace("来源：", "", $data);
    }

    return $data;
}