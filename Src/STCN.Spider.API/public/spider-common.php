<?php
require_once __DIR__ . '/../extend/topspider/autoloader.php';

use topspider\core\topspider;
use topspider\core\log;
use topspider\core\util;

ignore_user_abort();
set_time_limit(0);

define('ADD_DAY', "+3day"); // 3天前的数据不要
define('SCRIPT_DIR', __DIR__ . "/../spiderscript");
util::path_exists(SCRIPT_DIR);

//----统一回调处理 begin----//

/**
 * Summary of on_status_code
 * @param mixed $status_code
 * @param mixed $url
 * @param mixed $content
 * @param mixed $topspider
 * @return mixed
 */
function on_status_code($status_code, $url, $content, $topspider)
{
    // 如果状态码为429，说明对方网站设置了不让同一个客户端同时请求太多次
    if ($status_code == '429') {
        // 将url插入待爬的队列中,等待再次爬取
        $topspider->add_url($url);
        // 当前页先不处理了
        return false;
    }
    // 不拦截的状态码这里记得要返回，否则后面内容就都空了
    return $content;
};

/**
 * Summary of is_anti_spider
 * @param mixed $url
 * @param mixed $content
 * @param mixed $topspider
 * @return bool
 */
function is_anti_spider($url, $content, $topspider)
{
    // $content中包含"404页面不存在"字符串
    if (strpos($content, "404页面不存在") !== false) {
        // 如果使用了代理IP，IP切换需要时间，这里可以添加到队列等下次换了IP再抓取
        $topspider->add_url($url);
        return true; // 告诉框架网页被反爬虫了，不要继续处理它
    }
    // 当前页面没有被反爬虫，可以继续处理
    return false;
};

/**
 * Summary of on_start
 * @param mixed $spider
 * @return void
 */
function on_start($spider)
{
    // 把列表页重新加入增量更新抓取，这样不会排重url
    foreach ($spider::$configs['list_url_regexes'] as $url) {
        $spider->add_scan_url($url);
    }
}

/**
 * Summary of on_extract_field
 * @param mixed $fieldname
 * @param mixed $data
 * @param mixed $page
 * @return mixed
 */
function on_extract_field($fieldname, $data, $page)
{
    return $data;
}
//----统一回调处理 end----//

//----统一回调扩展 begin----//
function on_extract_field_extend($fieldname, $data, $page, $url, $configs){
    if (!empty($data)) {
        $data = trim(strip_tags($data)); // 去tag
        $removes = ['&nbsp;', '&#13;']; // 移除字符 /&#13;【 【 【	【\n
        $data = str_replace($removes, "", $data);
    }

    // 如果不是需要的栏目则不要 则返回false
    if($fieldname == "pub_channel_name"){
        // 如果栏目不为空并且配置的需要的栏目不为空及不是全部即*
        if (!empty($data) && (isset($configs['channel']) && !empty($configs['channel']) && $configs['channel'] != "*")) {
            if (strpos(" " . trim($configs['channel']) . " ", " " . trim($data) . " ") === false) { // 不是需要的栏目则不需要则返回false
                log::add("{$data} 不在 {$configs['channel']} url: {$url}\r\n", 'channel');
                return false;
            }else{
                // log::add("{$data} 在 {$configs['channel']}\r\n", 'channel');
            }
        }
    } elseif ($fieldname == 'source_pub_time') { // 日期不正确则丢弃
        $data = str_replace("年", "-", $data);
        $data = str_replace("月", "-", $data);
        $data = str_replace("日", " ", $data);

        $data = str_replace(".", "-", $data);

        if (strtotime($data) === false) {
            // log::add("日期不正确：{$data}\r\n", 'pubtime');
            return false;
        } else {
            // 30天前的数据不要
            if (strtotime($data . ADD_DAY) < time()) {
                log::add("日期太早：{$data}\r\n{$url}", 'pubtime');
                return false;
            }
        }
    }

    return $data;
}
function on_extract_page_extend($page, $fields, $url, $configs)
{
    // 打包网站属性关联字段
    if (!isset($fields['pub_source_name']) || empty($fields['pub_source_name'])) {
        $fields['pub_source_name'] = $configs['product_name'];
    }
    if (!isset($fields['pub_media_name']) || empty($fields['pub_media_name'])) {
        $fields['pub_media_name'] = $configs['media_name'];
    }
    if (!isset($fields['pub_product_name']) || empty($fields['pub_product_name'])) {
        $fields['pub_product_name'] = $configs['product_name'];
    }
    if (!isset($fields['pub_platform_name']) || empty($fields['pub_platform_name'])) {
        $fields['pub_platform_name'] = $configs['platform'];
    }
    // if (!isset($fields['pub_channel_name']) || empty($fields['pub_channel_name'])) {
    //     $fields['pub_channel_name'] = $configs['channel'];
    // }
    // 原文url
    $fields['source_url'] = $url;
    // 如果来源为空则为发布源
    // if (!isset($fields['source_name']) || empty($fields['source_name'])) {
    //     $fields['source_name'] = $fields['pub_source_name'];
    // }

    return $fields;
}
function on_before_insert_db($page, $fields, $url, $configs)
{
    // 日期不符合则丢弃
    if (isset($fields['source_pub_time']) && !empty($fields['source_pub_time'])) {
        $data = $fields['source_pub_time'];
        $data = str_replace("年", "-", $data);
        $data = str_replace("月", "-", $data);
        $data = str_replace("日", " ", $data);
        $data = str_replace(".", "-", $data);

        if (strtotime($data) === false) {
            // log::add("日期不正确：{$data}\r\n", 'pubtime');
            return false;
        } else {
            // 30天前的数据不要
            if (strtotime($data . ADD_DAY) < time()) {
                log::add("日期太早：{$data}\r\n{$url}", 'pubtime');
                return false;
            }
        }

        $fields['source_pub_time'] = $data;
    }

    return $fields;
}
//----统一回调扩展 begin----//