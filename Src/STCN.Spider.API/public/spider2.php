<?php
require_once __DIR__ . '/../extend/topspider/autoloader.php';
//require_once __DIR__ . '/../vendor/autoload.php';

use topspider\core\topspider;
use topspider\core\selector;

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
    // topspider::AGENT_ANDROID, 表示爬虫爬取网页时, 使用安卓手机浏览器
    // topspider::AGENT_IOS, 表示爬虫爬取网页时, 使用苹果手机浏览器
    // topspider::AGENT_PC, 表示爬虫爬取网页时, 使用PC浏览器
    // topspider::AGENT_MOBILE, 表示爬虫爬取网页时, 使用移动设备浏览器
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
        'name' => 'bjnews',
        'log_show' => true, // 查看日志tail -f data/topspider.log
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
            'prefix'    => 'topspider',
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
            'bjnews.com',
            'www.bjnews.com',
            'bjnews.com.cn',
            'www.bjnews.com.cn',
        ),
        // 定义爬虫的入口链接, 爬虫从这些链接开始爬取,同时这些链接也是监控爬虫所要监控的链接 数组类型 不能为空
        'scan_urls' => array(
            'https://www.bjnews.com.cn/news',
            'https://www.bjnews.com.cn/financial',
        ),
        // 定义列表页url的规则 对于有列表页的网站, 使用此配置可以大幅提高爬虫的爬取速率 列表页是指包含内容页列表的网页 数组类型 正则表达式 "http://www.qiushibaike.com/8hr/page/\d+\?s=\d+"
        'list_url_regexes' => array(
            "https://www.bjnews.com.cn/news",
            "https://www.bjnews.com.cn/news/\d+.html",
            "https://www.bjnews.com.cn/financial",
            "https://www.bjnews.com.cn/financial/\d+.html",
        ),
        // 定义内容页url的规则 内容页是指包含要爬取内容的网页数组类型 正则表达式 最好填写以提高爬取效率
        'content_url_regexes' => array(
            "https://www.bjnews.com.cn/detail/\d+.html",
        ),
        // 定义内容页的抽取规则 规则由一个个field组成, 一个field代表一个数据抽取项 数组类型 不能为空
        'fields' => array(
            array(
                'name' => "source_title",
                'selector' => "//div[@class='cgzzmL left mt20']/text()",
                'required' => true,
            ),
            array(
                'name' => "source_content",
                'selector' => "//div[contains(@class,'articleCenter')]",
                'required' => true,
            ),
            array(
                'name' => "source_pub_time",
                'selector' => "//span[contains(@class,'timer')]",
                'required' => true,
            ),
            array(
                'name' => "pub_channel_name",
                'selector' => "//div[contains(@class,'breadcrumb')]//a[2]//text()",
                'required' => true,
            ),
            array(
                'name' => "source_author",
                'selector' => "//span[contains(@class,'reporter')]//em",
                'required' => false,
            ),
            array(
                'name' => "source_name",
                'selector' => "//div[contains(@class,'detail-info')]//span[1]",
                'required' => false,
            ),
        ),
    );

    $spider = new topspider($configs);

    $spider->on_start = function ($topspider) {
        // add_sacn_url 没有URL去重机制，可用作增量更新
        $topspider->add_scan_url("http://www.stcn.com/article/list/yw.html");
        $topspider->add_scan_url("http://www.stcn.com/article/list/kx.html");
        $topspider->add_scan_url("http://www.stcn.com/article/list/company.html");
        $topspider->add_scan_url("http://www.stcn.com/article/list/gsxw.html");
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
        'log_show' => true, // 查看日志tail -f data/topspider.log
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
            'prefix'    => 'topspider',
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
        'list_url_regexes_remove' => '',
        'content_url_regexes_remove'=>'',
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
    $spider = new topspider($configs);
    $spider->on_start = function ($topspider) {
        // add_sacn_url 没有URL去重机制，可用作增量更新
        $topspider->add_scan_url("https://news.cnstock.com/news/sns_jg/index.html");
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



function on_start_stcn($spider)
{
    foreach ($spider::$configs['list_url_regexes'] as $url) {
        $spider->add_scan_url($url);
    }
}

function on_extract_field_stcn($fieldname, $data, $page)
{
    // if ($fieldname == 'source_author') {
    //     $data = str_replace("作者：", "", $data);
    // } elseif ($fieldname == 'source_name') {
    //     $data = str_replace("来源：", "", $data);
    // } elseif ($fieldname == 'source_content') {
    //     $data = selector::remove($data, "//div[contains(@class,'social-bar')]");
    // }

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
    // if ($fieldname == 'source_author') {
    //     $data = str_replace("作者：", "", $data);
    // } elseif ($fieldname == 'source_name') {
    //     $data = str_replace("来源：", "", $data);
    // }

    return $data;
}

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

// 列表页中配置附加数据，如栏目
// $configs = array(
//     // configs的其他成员
//     ...
//     'fields' => array(
//         array(
//             'name' => "question_view_count",
//             // 在内容页中通过XPath提取浏览次数(或阅读量)
//             'selector' => "//a[contains(@class,'page-view')]",
//             'required' => true,
//         ),
//     ),
// );

// $spider->on_list_page = function($page, $content, $topspider) 
// {
//     // 在列表页中通过XPath提取到内容页URL
//     $content_url = selector::select($content, "//a[contains(@class,'s xst')]/@href");
//     // 在列表页中通过XPath提取到浏览次数(或阅读量)
//     $page_views = selector::select($content, "//td[contains(@class,'num')]/em");
//     // 拼出包含浏览次数(或阅读量)的HTML代码
//     $page_views = '<div><a class="page-view">' . $page_views + '</a></div>';

//     $options = array(
//         'method' => 'get',
//         'context_data' => $page_views,
//     );

//     $topspider->add_url($content_url, $options);
//     // 返回true继续提取其他列表页URL
//     return true;
// };

// 举个栗子:
// 当爬取的网页中某些内容需要异步加载请求时，就需要使用attached_url，比如，抓取知乎回答中的评论部分，就是通过AJAX异步请求的数据

// array(
//     'name' => "comment_id",
//     'selector' => "//div/@data-aid",
// ),
// array(
//     'name' => "comments",
//     'source_type' => 'attached_url',
//     // "comments"是从发送"attached_url"这个异步请求返回的数据中抽取的
//     // "attachedUrl"支持引用上下文中的抓取到的"field", 这里就引用了上面抓取的"comment_id"
//     'attached_url' => "https://www.zhihu.com/r/answers/{comment_id}/comments",
//     'selector_type' => 'jsonpath'
//     'selector' => "$.data",
//     'repeated => true,
//     'children' => array(
//         ...
//     )
// }

// XPATH的几个常用函数

// 1.contains ()： //div[contains(@id, 'in')] ,表示选择id中包含有’in’的div节点

// 2.text()：由于一个节点的文本值不属于属性，比如<a class=”baidu“ href=”http://www.baidu.com“>baidu</a>,所以，用text()函数来匹配节点：//a[text()='baidu']

// 3.last()：//div[contains(@id, 'in')][last()]，表示选择id中包含有'in'的div节点的最后一个节点

// 4.starts-with()： //div[starts-with(@id, 'in')] ，表示选择以’in’开头的id属性的div节点

// 5.not()函数，表示否定，//input[@name=‘identity’ and not(contains(@class,‘a’))] ，表示匹配出name为identity并且class的值中不包含a的input节点。 not()函数通常与返回值为true or false的函数组合起来用，比如contains(),starts-with()等，但有一种特别情况请注意一下：我们要匹配出input节点含有id属性的，写法如下：//input[@id]，如果我们要匹配出input节点不含用id属性的，则为：//input[not(@id)]