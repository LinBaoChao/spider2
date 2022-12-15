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

                // 绑定回调函数 从业务配置中是否有回调函数，及动态脚本，可以把脚本存入某个文件里，然后上面引入这个文件，即可回调到这个函数
                // 目前支持回调函数有on_start、on_extract_field、on_extract_page、on_scan_page、on_list_page、on_content_page、on_handle_img、on_download_page、on_download_attached_page、on_fetch_url、on_status_code、is_anti_spider、on_attachment_file
                if(!empty($config['callback_method'])){
                    $name = $config['name'];
                    foreach($config['callback_method'] as $cbmd){
                        $methodName = "{$cbmd}_{$name}"; // 函数命名规则约定：函数名+_+媒体标识
                        switch($cbmd){
                            case "on_start":
                                $spider->on_start = $methodName;
                                break;
                            case "on_extract_field":
                                $spider->on_extract_field = $methodName; 
                                break;
                            case "on_extract_page":
                                $spider->on_extract_page = $methodName;
                                break;
                            case "on_scan_page":
                                $spider->on_scan_page = $methodName;
                                break;
                            case "on_list_page":
                                $spider->on_list_page = $methodName;
                                break;
                            case "on_content_page":
                                $spider->on_list_page = $methodName;
                                break;
                            case "on_handle_img":
                                $spider->on_list_page = $methodName;
                                break;
                            case "on_download_page":
                                $spider->on_list_page = $methodName;
                                break;
                            case "on_download_attached_page":
                                $spider->on_download_attached_page = $methodName;
                                break;
                            case "on_fetch_url":
                                $spider->on_list_page = $methodName;
                                break;
                            case "on_status_code":
                                $spider->on_status_code = $methodName;
                                break;
                            case "is_anti_spider":
                                $spider->is_anti_spider = $methodName;
                                break;
                            case "on_attachment_file":
                                $spider->on_attachment_file = $methodName;
                                break;
                        }
                    }
                }
                // $spider->on_start = "onStart";
                // $spider->on_extract_field = "onExtractField";
                $spider->start();

                usleep(1000); // 微秒
            }
        }

        sleep($sleepSeconds);
    } while ($doFlag);
}

function on_start_stcn($spider)
{
    foreach ($spider::$configs['list_url_regexes'] as $url) {
        $spider->add_scan_url($url);
    }
}

function on_extract_field_stcn($fieldname, $data, $page)
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

function on_start_cnstock($spider)
{
    foreach ($spider::$configs['list_url_regexes'] as $url) {
        $spider->add_scan_url($url);
    }
}

function on_extract_field_cnstock($fieldname, $data, $page)
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
