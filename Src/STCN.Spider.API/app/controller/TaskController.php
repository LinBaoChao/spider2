<?php

//declare(strict_types=1);

namespace app\controller;

//require_once '/extend/phpspider/autoloader.php';

use app\BaseController;
use phpspider\core\phpspider;
use phpspider\core\selector;

class TaskController extends BaseController
{
    public function spider()
    {
        ignore_user_abort();
        set_time_limit(0);

        $doFlag = true;
        $sleepSeconds = 60 * 60 * 1; // 1小时

        do {
            $configs = array(
                'name' => 'stcn.com',
                'log_show' => true, // 查看日志tail -f data/phpspider.log
                //'log_type' => 'error,debug',
                'multiserver' => true,
                'serverid' => 1,
                'tasknum' => 3,
                'save_running_state' => true,
                'max_try' => 5, // 爬虫爬取每个网页失败后尝试次数
                //redis
                'queue_config' => array(
                    'host'      => '127.0.0.1',
                    'port'      => 6379,
                    'pass'      => '',
                    'db'        => 5,
                    'prefix'    => 'phpspider',
                    'timeout'   => 30,
                ),
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
                // 定义爬虫爬取哪些域名下的网页, 非域名下的url会被忽略以提高爬取速度
                'domains' => array(
                    'stcn.com',
                    'www.stcn.com',
                ),
                // 定义爬虫的入口链接, 爬虫从这些链接开始爬取,同时这些链接也是监控爬虫所要监控的链接 数组类型 不能为空
                'scan_urls' => array(
                    'http://www.stcn.com/',
                ),
                // 定义列表页url的规则 对于有列表页的网站, 使用此配置可以大幅提高爬虫的爬取速率 列表页是指包含内容页列表的网页 数组类型 正则表达式 "http://www.qiushibaike.com/8hr/page/\d+\?s=\d+"
                'list_url_regexes' => array(
                    "http://www.stcn.com/article/list/yw.html",
                    "http://www.stcn.com/article/list/kx.html",
                    "http://www.stcn.com/article/list/company.html",
                    "http://www.stcn.com/article/list/gsxw.html",
                ),
                // 定义内容页url的规则 内容页是指包含要爬取内容的网页数组类型 正则表达式 最好填写以提高爬取效率
                'content_url_regexes' => array(
                    "http://www.stcn.com/article/detail/\d+.html",
                ),
                // 定义内容页的抽取规则 规则由一个个field组成, 一个field代表一个数据抽取项 数组类型 不能为空
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

            $spider->on_start = function ($phpspider) {
                // add_sacn_url 没有URL去重机制，可用作增量更新
                $phpspider->add_scan_url("http://www.stcn.com/article/list/yw.html");
                $phpspider->add_scan_url("http://www.stcn.com/article/list/kx.html");
                $phpspider->add_scan_url("http://www.stcn.com/article/list/company.html");
                $phpspider->add_scan_url("http://www.stcn.com/article/list/gsxw.html");
            };

            $spider->on_extract_field = function ($fieldname, $data, $page) {
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
            };
            $spider->start();

            $configs = array(
                'name' => 'cnstock.com',
                'log_show' => true, // 查看日志tail -f data/phpspider.log
                //'log_type' => 'error,debug',
                'multiserver' => true,
                'serverid' => 1,
                'tasknum' => 3,
                'save_running_state' => true,
                //redis
                'queue_config' => array(
                    'host'      => '127.0.0.1',
                    'port'      => 6379,
                    'pass'      => '',
                    'db'        => 5,
                    'prefix'    => 'phpspider',
                    'timeout'   => 30,
                ),
                'max_try' => 5, // 爬虫爬取每个网页失败后尝试次数
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
                // 定义爬虫爬取哪些域名下的网页, 非域名下的url会被忽略以提高爬取速度
                'domains' => array(
                    'news.cnstock.com',
                    'www.news.cnstock.com'
                ),
                // 定义爬虫的入口链接, 爬虫从这些链接开始爬取,同时这些链接也是监控爬虫所要监控的链接 数组类型 不能为空
                'scan_urls' => array(
                    'https://news.cnstock.com/',
                ),
                // 定义列表页url的规则 对于有列表页的网站, 使用此配置可以大幅提高爬虫的爬取速率 列表页是指包含内容页列表的网页 数组类型 正则表达式 "http://www.qiushibaike.com/8hr/page/\d+\?s=\d+"
                'list_url_regexes' => array(
                    "https://news.cnstock.com/news/sns_jg/index.html",
                ),
                // 定义内容页url的规则 内容页是指包含要爬取内容的网页数组类型 正则表达式 最好填写以提高爬取效率
                'content_url_regexes' => array(
                    "https://news.cnstock.com/news,bwkx-\d+-\d+.htm",
                ),
                // 定义内容页的抽取规则 规则由一个个field组成, 一个field代表一个数据抽取项 数组类型 不能为空
                'fields' => array(
                    array(
                        'name' => "title",
                        'selector' => "//h1[contains(@class,'title')]",
                        'required' => true,
                    ),
                    array(
                        'name' => "author",
                        'selector' => "//span[contains(@class,'author')]",
                        'required' => true,
                    ),
                    array(
                        'name' => "source",
                        'selector' => "//span[contains(@class,'source')]//a[2]",
                        'required' => false,
                    ),
                    array(
                        'name' => "publish_time",
                        'selector' => "//span[contains(@class,'timer')]",
                        'required' => true,
                    ),
                    array(
                        'name' => "content",
                        'selector' => "//div[contains(@id,'content')]",
                        'required' => true,
                    ),
                    array(
                        'name' => "url",
                        'selector' => "//span[contains(@class,'source')]",
                        'required' => false,
                    ),
                    // array(
                    //     'name' => "editor",
                    //     'selector' => "//div[contains(@class,'edit cf')]",
                    //     'required' => false,
                    // ),
                    array(
                        'name' => "news_type",
                        'selector' => "//span[contains(@class,'current')]//a",
                        'required' => false,
                    ),
                ),
            );
            $spider = new phpspider($configs);
            $spider->on_start = function ($phpspider) {
                // add_sacn_url 没有URL去重机制，可用作增量更新
                $phpspider->add_scan_url("https://news.cnstock.com/news/sns_jg/index.html");
            };
            $spider->on_extract_field = function (
                $fieldname,
                $data,
                $page
            ) {
                if (
                    $fieldname == 'url'
                ) {
                    $data = $page['url'];
                } elseif ($fieldname == 'author') {
                    $data = str_replace("作者：", "", $data);
                } elseif ($fieldname == 'source') {
                    $data = str_replace("来源：", "", $data);
                } elseif ($fieldname == 'editor') {
                    $data = str_replace("责任编辑： ", "", $data);
                }
                return $data;
            };
            $spider->start();

            sleep($sleepSeconds);
        } while ($doFlag);
    }
}