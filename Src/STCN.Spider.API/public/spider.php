<?php
require_once __DIR__ . '/../extend/phpspider/autoloader.php';

use phpspider\core\phpspider;

/* Do NOT delete this comment */
/* 不要删除这段注释 */

$configs = array(
    'name' => '证券时报网',
    'log_show' => true,
    //'log_type' => 'error,debug',
    //'multiserver' => true,
    //'serverid' => 1,
    //'tasknum' => 3,
    //'save_running_state' => true,
    //'input_encoding' => 'utf-8',
    //'max_depth' => 3,
    'domains' => array(
        'stcn.com',
        'www.stcn.com'
    ),
    'scan_urls' => array(
        'http://www.stcn.com/',
    ),
    'list_url_regexes' => array(
        "http://www.stcn.com/article/list/yw.html",
    ),
    'content_url_regexes' => array(
        "http://www.stcn.com/article/detail/\d+.html",
    ),
    'max_try' => 5,
    // 'proxies' => array(
    //     'http://H784U84R444YABQD:57A8B0B743F9B4D2@proxy.abuyun.com:9010'
    // ),
    //'export' => array(
        //'type' => 'csv',
        //'file' => '../data/qiushibaike.csv',
    //),
    //'export' => array(
        //'type'  => 'sql',
        //'file'  => '../data/qiushibaike.sql',
        //'table' => 'content',
    //),
    'export' => array(
        'type' => 'db', 
        'table' => 'article_spider',
    ),
    'db_config' => array(
        'host'  => '127.0.0.1',
        'port'  => 3306,
        'user'  => 'root',
        'pass'  => '123456',
        'name'  => 'stcn_spider',
    ),
    // 'queue_config' => array(
    //     'host'      => '127.0.0.1',
    //     'port'      => 6379,
    //     'pass'      => '',
    //     'db'        => 5,
    //     'prefix'    => 'phpspider',
    //     'timeout'   => 30,
    // ),
    'fields' => array(
        array(
            'name' => "title",
            'selector' => "//div[contains(@class,'detail-title')]",
            'required' => true,
        ),
        array(
            'name' => "author",
            'selector' => "//div[contains(@class,'detail-info')]//span[2]",
            'required' => true,
        ),
        array(
            'name' => "source",
            'selector' => "//div[contains(@class,'detail-info')]//span[1]",
            'required' => false,
        ),
        array(
            'name' => "publish_time",
            'selector' => "//div[contains(@class,'detail-info')]//span[3]",
            'required' => true,
        ),
        array(
            'name' => "content",
            'selector' => "//div[contains(@class,'detail-content')]",
            'required' => true,
        ),        
        array(
            'name' => "url",
            'selector' => "//div[contains(@class,'detail-info')]//span[2]",
            'required' => true,
        ),
        array(
            'name' => "editor",
            'selector' => "//div[contains(@class,'detail-content-editor')]",
            'required' => false,
        ),
        array(
            'name' => "news_type",
            'selector' => "//div[contains(@class,'breadcrumb')]//a[2]",
            'required' => false,
        ),
    ),
);

$spider = new phpspider($configs);

$spider->on_extract_field = function ($fieldname, $data, $page) {
    if ($fieldname == 'url') {
        $data = $page['url'];
    } elseif ($fieldname == 'author') {
        $data = str_replace("作者：","",$data);
    } elseif ($fieldname == 'source') {
        $data = str_replace("来源：", "", $data);
    } elseif ($fieldname == 'editor') {
        $data = str_replace("责任编辑： ", "", $data);
    }

    return $data;
};

$spider->start();
