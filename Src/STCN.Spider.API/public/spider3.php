<?php
require_once __DIR__ . '/spider-common.php';

use topspider\core\topspider;
use topspider\core\website;
use topspider\core\log;

function runSpider()
{
    ignore_user_abort();
    set_time_limit(0);

    $spiderConfig = include_once(__DIR__ . '/../config/spider.php');
    // 是否运行
    $isRunSpider = isset($spiderConfig['is_run_spider']) ? $spiderConfig['is_run_spider'] : true;

    // 轮询间隔 秒
    $sleepSeconds = isset($spiderConfig['sleep_seconds']) ? $spiderConfig['sleep_seconds'] : 60 * 5;

    // 抓的网站
    $websites = ['youthnews', 'youthfinance', 'cyolcom', 'wwwcecn', 'rmzxbcomcn', 'haiwainetcn', 'qizhiwangorg'];

    do {
        try {
            $configs = website::getWebsiteConfig();
            if (!empty($configs) && $configs['code'] == 'success') {
                $configs = $configs['result'];
                foreach ($configs as $config) {
                    try {
                        if (!in_array($config['name'], $websites)) {
                            log::add("noin：{$config['name']}\r\n", 'website3');
                            continue;
                        }

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

                        $spider->start();
                        usleep(1000); // 微秒，休息一下，大量的时候可以缓解下cpu
                        log::add($config['name'],'runtimes3');
                    } catch (\Exception $ex) {
                        $configstr = var_export($config, true);
                        log::add("爬取配置出错：{$ex->getMessage()}\r\n config：{$configstr}\r\n", 'runSpiderErr3');
                    }
                }
            }

            sleep($sleepSeconds); // 轮询更新周期 秒
        } catch (\Exception $ex) {
            log::add("run spider err：{$ex->getMessage()}\r\n", 'runSpiderErr3');
        }
    } while ($isRunSpider);
}

// 运行开始爬虫
runSpider();