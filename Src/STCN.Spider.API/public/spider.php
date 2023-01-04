<?php
require_once __DIR__ . '/../extend/phpspider/autoloader.php';
//require_once __DIR__ . '/../vendor/autoload.php';

use phpspider\core\phpspider;
use phpspider\core\selector;
use phpspider\core\website;
use phpspider\core\log;
use phpspider\core\util;

ignore_user_abort();
set_time_limit(0);

define('SCRIPT_DIR', __DIR__ . "/../spiderscript");
util::path_exists(SCRIPT_DIR);

// 生成脚本保存到文件及动态引入
// $configs = website::getWebsiteConfig();
// if (!empty($configs) && $configs['code'] == 'success') {
//     $configs = $configs['result'];
//     foreach ($configs as $config) {
//         try {
//             // 回调脚本，把脚本存成一个以媒体标识名为名字的php文件，然后动态包入此文件，即可供上面的回调函数来调用此脚本
//             if (isset($config['callback_script']) && !empty($config['callback_script'])) {
//                 //echo $config['callback_script'];
//                 $name = $config['name'];
//                 // 保存到文件
//                 $dir = SCRIPT_DIR . "/";
//                 $filename = $dir . $name . '.php';

//                 $head = <<<STR
//                 <?php
//                 require_once __DIR__ . '/../extend/phpspider/autoloader.php';
//                 use phpspider\core\phpspider;
//                 use phpspider\core\selector;
//                 use phpspider\core\website;
//                 use phpspider\core\log;
//                 use phpspider\core\util;

//                 STR;

//                 //file_put_contents($filename, "<?php", FILE_APPEND | LOCK_EX);
//                 file_put_contents($filename, $head . $config['callback_script']);
//                 // 动态包入
//                 include_once($filename);
//             }
//         } catch (\Exception $ex) {
//             $configstr = var_export($config, true);
//             log::add("脚本配置出错：{$ex->getMessage()}\r\n config：{$configstr}\r\n", 'spiderScriptErr');
//         }
//     }
// }
// ---------------------------------------

function runSpider()
{
    ignore_user_abort();
    set_time_limit(0);

    $spiderConfig = include_once(__DIR__ . '/../config/spider.php');
    // 是否运行
    $isRunSpider = isset($spiderConfig['is_run_spider']) ? $spiderConfig['is_run_spider'] : true;

    // 轮询间隔 秒
    $sleepSeconds = isset($spiderConfig['sleep_seconds']) ? $spiderConfig['sleep_seconds'] : 60 * 60 * 2;

    do {
        try {
            $configs = website::getWebsiteConfig();
            if (!empty($configs) && $configs['code'] == 'success') {
                $configs = $configs['result'];
                foreach ($configs as $config) {
                    try {
                        $spider = new phpspider($config);

                        // 统一处理，如果设置了个性处理，下面会替换成设置的
                        $spider->on_status_code = 'on_status_code'; // 总处理反爬
                        $spider->is_anti_spider = 'is_anti_spider'; // 总处理反爬
                        $spider->on_start = 'on_start';
                        $spider->on_extract_field = 'on_extract_field';

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
                            require_once __DIR__ . '/../extend/phpspider/autoloader.php';
                            use phpspider\core\phpspider;
                            use phpspider\core\selector;
                            use phpspider\core\website;
                            use phpspider\core\log;
                            use phpspider\core\util;

                            STR;
                            
                            file_put_contents($filename, $head . $config['callback_script']);

                            // 动态包入
                            include_once($filename);
                        }

                        $spider->start();
                        usleep(1000); // 微秒，休息一下，大量的时候可以缓解下cpu
                        log::add($config['name'],'runtimes');
                    } catch (\Exception $ex) {
                        $configstr = var_export($config, true);
                        log::add("爬取配置出错：{$ex->getMessage()}\r\n config：{$configstr}\r\n", 'runSpiderErr');
                    }
                }
            }

            sleep($sleepSeconds); // 轮询更新周期 秒
        } catch (\Exception $ex) {
            log::add("run spider err：{$ex->getMessage()}\r\n", 'runSpiderErr');
        }
    } while ($isRunSpider);
}

// 运行开始爬虫
runSpider();

//----统一回调处理 begin----//

/**
 * Summary of on_status_code
 * @param mixed $status_code
 * @param mixed $url
 * @param mixed $content
 * @param mixed $phpspider
 * @return mixed
 */
function on_status_code($status_code, $url, $content, $phpspider)
{
    // 如果状态码为429，说明对方网站设置了不让同一个客户端同时请求太多次
    if ($status_code == '429') {
        // 将url插入待爬的队列中,等待再次爬取
        $phpspider->add_url($url);
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
 * @param mixed $phpspider
 * @return bool
 */
function is_anti_spider($url, $content, $phpspider)
{
    // $content中包含"404页面不存在"字符串
    if (strpos($content, "404页面不存在") !== false) {
        // 如果使用了代理IP，IP切换需要时间，这里可以添加到队列等下次换了IP再抓取
        $phpspider->add_url($url);
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

// function on_start_stcn($spider)
// {
//     foreach ($spider::$configs['list_url_regexes'] as $url) {
//         $spider->add_scan_url($url);
//     }
// }

// function on_extract_field_stcn($fieldname, $data, $page)
// {
//     if ($fieldname == 'source_author') {
//         $data = str_replace("作者：", "", $data);
//     } elseif ($fieldname == 'source_name') {
//         $data = str_replace("来源：", "", $data);
//     } elseif ($fieldname == 'source_content') {
//         $data = selector::remove($data, "//div[contains(@class,'social-bar')]");
//     }

//     return $data;
// }

// function on_start_cnstock($spider)
// {
//     foreach ($spider::$configs['list_url_regexes'] as $url) {
//         $spider->add_scan_url($url);
//     }
// }

// function on_extract_field_cnstock($fieldname, $data, $page)
// {
//     if ($fieldname == 'source_author') {
//         $data = str_replace("作者：", "", $data);
//     } elseif ($fieldname == 'source_name') {
//         $data = str_replace("来源：", "", $data);
//     }

//     return $data;
// }