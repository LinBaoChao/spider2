<?php
require_once __DIR__ . '/../extend/phpspider/autoloader.php';
//require_once __DIR__ . '/../vendor/autoload.php';

use phpspider\core\phpspider;
use phpspider\core\selector;
use phpspider\core\website;

ignore_user_abort();
set_time_limit(0);

function runSpider()
{
    ignore_user_abort();
    set_time_limit(0);

    $doFlag = true;
    $sleepSeconds = 60 * 60 * 1; // 1小时

    do {
        $configs = website::getWebsiteConfig();
        if (!empty($configs) && $configs['code'] == 'success') {
            $configs = $configs['result'];
            foreach ($configs as $config) {
                $spider = new phpspider($config);
                $spider->on_start = "onStart";
                $spider->on_extract_field = "onExtractField";
                $spider->start();

                usleep(1000); // 微秒
            }
        }

        sleep($sleepSeconds);
    } while ($doFlag);
}

function onStart($spider)
{
    foreach ($spider::$configs['list_url_regexes'] as $url) {
        $spider->add_scan_url($url);
    }
}

function onExtractField($fieldname, $data, $page)
{
    if (
        $fieldname == 'url'
    ) {
        $data = $page['url'];
    } elseif ($fieldname == 'author') {
        $data = str_replace("作者：", "", $data);
    } elseif ($fieldname == 'source') {
        $data = str_replace("来源：", "", $data);
    } elseif ($fieldname == 'editor') {
        $data = str_replace(
            "责任编辑： ",
            "",
            $data
        );
    } elseif ($fieldname == 'content') {
        $data = selector::remove($data, "//div[contains(@class,'social-bar')]");
    }

    return $data;
}

runSpider();
