<?php
require_once __DIR__ . '/../extend/phpspider/autoloader.php';
//require_once __DIR__ . '/../vendor/autoload.php';

use phpspider\core\phpspider;
use phpspider\core\selector;

/* Do NOT delete this comment */
/* 不要删除这段注释 */

ignore_user_abort();
set_time_limit(0);

$doFlag = true;
$sleepSeconds = 60 * 60 * 1; // 1小时

do {
    //'input_encoding' => 'utf-8',
    // 'output_encoding' => 'GB2312'
    // 'interval' => 1000, // 爬虫爬取每个网页的时间间隔 单位：毫秒
    // 'timeout' => 5, // 爬虫爬取每个网页的超时时间 单位：秒
    //'max_depth' => 3, // 爬虫爬取网页深度，超过深度的页面不再采集 默认值为0，即不限制
    // 'max_fields' => 100, // 爬虫爬取内容网页最大条数 抓取到一定的字段后退出 默认值为0，即不限制

    // 随机浏览器类型，用于破解防采集
    // phpspider::AGENT_ANDROID, 表示爬虫爬取网页时, 使用安卓手机浏览器
    // phpspider::AGENT_IOS, 表示爬虫爬取网页时, 使用苹果手机浏览器
    // phpspider::AGENT_PC, 表示爬虫爬取网页时, 使用PC浏览器
    // phpspider::AGENT_MOBILE, 表示爬虫爬取网页时, 使用移动设备浏览器
    // 'user_agent' => array(
    //     "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Safari/537.36",
    //     "Mozilla/5.0 (iPhone; CPU iPhone OS 9_3_3 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13G34 Safari/601.1",
    //     "Mozilla/5.0 (Linux; U; Android 6.0.1;zh_cn; Le X820 Build/FEXCNFN5801507014S) AppleWebKit/537.36 (KHTML, like Gecko)Version/4.0 Chrome/49.0.0.0 Mobile Safari/537.36 EUI Browser/5.8.015S",
    // ),

    // 随机伪造IP，用于破解防采集
    // 'client_ip' => array(
    //     '192.168.0.2',
    //     '192.168.0.3',
    //     '192.168.0.4',
    // ),

    // 代理服务器 如果爬取的网站根据IP做了反爬虫, 可以设置此项
    // 'proxies' => array(
    //     'http://H784U84R444YABQD:57A8B0B743F9B4D2@proxy.abuyun.com:9010',
    //     'http://user:pass@host:port',
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

//$html =<<<STR
//<div id="demo">
//aaa
//<span class="tt">bbb</span>
//<span>ccc</span>
//<p>ddd</p>
//</div>
//STR;

// $html = <<<STR
// <div class="social-bar">
//               <div class="tt">点赞</div>
//               <div class="like like-btn " data-id="743709" data-url="/operation/like.html"/>
//               <div class="fav post-btn " data-id="743709" data-url="/operation/collect.html"/>
//               <a class="comment" href="#comment"/>
//               <div class="tt">分享</div>
//               <div class="share-popup social-share" data-initialized="true" data-title="机器人流程自动化平台加速智能化，企业顶层设计仍有这些痛点" data-description="机器人流程自动化平台加速智能化，企业顶层设计仍有这些痛点" data-image="" data-url="https://h5.stcn.com/pages/detail/detail?id=743709&amp;jump_type=reported_info">
//                 <a class="social-share-icon icon-wechat wx"/>
//                 <a class="social-share-icon icon-qzone qq"/>
//                 <a class="social-share-icon icon-weibo wb"/>
//               </div>
//             </div>
//             <div class="detail-content">
//                                                         </div>
//                           <div class="detail-content-editor">责任编辑： 陈勇洲</div>
//                         <div class="detail-content-tags">
//                 <!--普通文章标签-->
//                                 <div>基金</div>
//                                 <div>机器人</div>
//                                 <div>自动化</div>
//                                 <!--快讯标签-->
//             </div>
// STR;
// $data = selector::select($html, "//div[contains(@class,'detail-content')]");
// $d = str_replace($data, "", $html);
// print_r($data);