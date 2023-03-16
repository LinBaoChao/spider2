<?php
require_once __DIR__ . '/../extend/topspider/autoloader.php';
//require_once __DIR__ . '/../vendor/autoload.php';

use topspider\core\topspider;
use topspider\core\selector;
use topspider\core\website;
use topspider\core\log;
use topspider\core\util;

ignore_user_abort();
set_time_limit(0);

define('ADD_DAY', "+3day"); // 3天前的数据不要
define('SCRIPT_DIR', __DIR__ . "/../spiderscript");
util::path_exists(SCRIPT_DIR);

const NEWLINE = "\n\n";

/**
 * 爬取入口函数，多进程处理
 * @return void
 */
function main()
{
    if (strtolower(php_sapi_name()) != 'cli') {
        die("请在cli模式下运行");
    }

    // global $argv;
    // $start_file = $argv[0];
    // exec("ps aux | grep $start_file | grep -v grep | awk '{print $2}' |xargs kill -SIGKILL");

    log::add("当前进程：" . getmypid() . "\r\n", 'runspider');
    log::add("===========开始启动多任务爬取===========\r\n", 'runspider');

    $second = 60 * 10; // 10分钟轮询库
    $websites = [];
    $count = 0;

    do {
        try {
            $configs = website::getWebsiteConfig();
            if (!empty($configs) && $configs['code'] == 'success') {
                $configs = $configs['result'];
                foreach ($configs as $config) {
                    $name = $config['name'];
                    if(array_key_exists($name,$websites)){
                        continue;
                    }

                    // fork后父进程会走自己的逻辑，子进程从处开始走自己的逻辑，堆栈信息会完全复制给子进程内存空间，父子进程相互独立
                    $pid = pcntl_fork();
                    if ($pid == -1) { // 失败
                        log::add("[{$name}]创建爬取任务失败\r\n", 'runspider');
                    } else if ($pid) { // 父进程
                        $websites[$name] = $pid;
                        $count++;
                        log::add("[{$name}]创建爬取任务{$count}成功{$pid}\r\n", 'runspider');
                        sleep(60); // 睡1分钟再创建子任务，这样就可以错开休息，有效缓解同时资源占用
                        // pcntl_wait($status); // 防止僵尸子进程
                    } else { // 子进程
                        runSpider($name);
                    }
                }
            }
        } catch (\Exception $ex) {
            log::add("main轮询时出错：{$ex->getMessage()}\r\n", 'runspider');
        }

        sleep($second);
    } while (true);

    //echo "==============END=============" . NEWLINE;
}

/**
 * 单个网站抓取进程
 * @param mixed $mediaId 网站名称标识
 * @return void
 */
function runSpider($mediaId)
{
    ignore_user_abort();
    set_time_limit(0);

    $isRunSpider = true;
    $runtimes = 0;

    do {
        $runtimes++;

        try {
            $spiderConfig = include_once(__DIR__ . '/../config/spider.php');
            // 是否运行
            $isRunSpider = isset($spiderConfig['is_run_spider']) ? $spiderConfig['is_run_spider'] : true;
            // 轮询间隔 秒
            $sleepSeconds = isset($spiderConfig['sleep_seconds']) ? $spiderConfig['sleep_seconds'] : 60 * 5;

            $configs = website::getWebsiteConfig($mediaId, 1);
            if (!empty($configs) && $configs['code'] == 'success') {
                $configs = $configs['result'];
                foreach ($configs as $config) {
                    try {
                        $spider = new topspider($config);

                        // 统一处理，如果设置了个性处理，下面会替换成设置的
                        $spider->on_status_code = 'on_status_code'; // 总处理反爬
                        $spider->is_anti_spider = 'is_anti_spider'; // 总处理反爬
                        $spider->on_start = 'on_start';
                        $spider->on_extract_field = 'on_extract_field';
                        // 回调扩展
                        $spider->on_extract_field_extend = 'on_extract_field_extend'; 
                        $spider->on_extract_page_extend = 'on_extract_page_extend'; // 加入非配置的特殊字段处理
                        $spider->on_before_insert_db = 'on_before_insert_db'; // 入库前统一回调处理

                        // 绑定回调函数 从业务配置中是否有回调函数，及动态脚本，可以把脚本存入某个文件里，然后上面引入这个文件，即可回调到这个函数
                        // 目前支持回调函数有on_start、on_extract_field、on_extract_page、on_scan_page、on_list_page、on_content_page、on_handle_img、on_download_page、on_download_attached_page、on_fetch_url、on_status_code、is_anti_spider、on_attachment_file
                        if (isset($config['callback_method']) && !empty($config['callback_method'])) {
                            $name = $config['name'];
                            foreach ($config['callback_method'] as $method) {
                                $methodName = "{$method}_{$name}"; // 函数命名规则约定：函数名+_+媒体标识
                                switch ($method) {
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

                        // 回调脚本，把脚本存成一个以媒体标识名为名字的php文件，然后动态包入此文件，即可供上面的回调函数来调用此脚本
                        if (isset($config['callback_script']) && !empty($config['callback_script'])) {
                            // 保存到文件
                            $dir = SCRIPT_DIR . "/";
                            $filename = $dir . $name . '.php';

                            $head = <<<STR
                            <?php
                            require_once __DIR__ . '/../extend/topspider/autoloader.php';
                            use topspider\core\\topspider;
                            use topspider\core\selector;
                            use topspider\core\website;
                            use topspider\core\log;
                            use topspider\core\util;

                            STR;

                            file_put_contents($filename, $head . $config['callback_script']);

                            // 动态包入
                            include_once($filename);
                        }

                        log::add("[{$mediaId}]第{$runtimes}次开始爬取", 'runspider');
                        $spider->start();
                        log::add("[{$mediaId}]第{$runtimes}次完成爬取", 'runspider');
                    } catch (\Exception $ex) {
                        $configstr = var_export($config, true);
                        log::add("[{$mediaId}]第{$runtimes}次时爬取配置出错：{$ex->getMessage()}\r\n config：{$configstr}\r\n", 'runspider');
                    }
                }
            }else{
                log::add("[{$mediaId}]第{$runtimes}次时已停用\r\n", 'runspider');
            }

            sleep($sleepSeconds); // 轮询更新周期 秒
        } catch (\Exception $ex) {
            log::add("[{$mediaId}]第{$runtimes}次时运行出错：{$ex->getMessage()}\r\n", 'runspider');
        }
    } while ($isRunSpider);
}

// 运行开始爬虫
main();

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