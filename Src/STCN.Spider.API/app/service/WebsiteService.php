<?php

declare(strict_types=1);

namespace app\service;

use app\model\Website;
use app\model\WebsiteField;
use enum\ResultCode;
use think\facade\Config;
use think\facade\Log;
use utils\Result;

class WebsiteService
{
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

    // $configs = array(
    //         'name' => 'stcn.com',
    //         'log_show' => true, // 查看日志tail -f data/phpspider.log
    //         'log_file' => 'data/qiushibaike.log',
    //         'log_type' => 'error,debug,info,warn',
    //         'input_encoding' => 'GB2312',
    //         'output_encoding' => 'UTF-8',
    //         'tasknum' => 3,
    //         'multiserver' => true,
    //         'serverid' => 1,
    //         'save_running_state' => true,
    //         //redis
    //         'queue_config' => array(
    //             'host'      => '127.0.0.1',
    //             'port'      => 6379,
    //             'pass'      => '',
    //             'db'        => 5,
    //             'prefix'    => 'phpspider',
    //             'timeout'   => 30,
    //         ),
    //         'proxy' => array('http://user:pass@host:port'),
    //         'interval' => 1000,
    //         'timeout' => 5,
    //         'max_try' => 5, // 爬虫爬取每个网页失败后尝试次数
    //         'max_depth' => 5,
    //         'max_fields' => 100,
    //         'user_agent' => array(
    //             "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Safari/537.36",
    //             "Mozilla/5.0 (iPhone; CPU iPhone OS 9_3_3 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13G34 Safari/601.1",
    //             "Mozilla/5.0 (Linux; U; Android 6.0.1;zh_cn; Le X820 Build/FEXCNFN5801507014S) AppleWebKit/537.36 (KHTML, like Gecko)Version/4.0 Chrome/49.0.0.0 Mobile Safari/537.36 EUI Browser/5.8.015S",
    //         ),
    //         'client_ip' => array(
    //             '192.168.0.2',
    //             '192.168.0.3',
    //             '192.168.0.4',
    //         ),
    //         'export' => array(
    //             'type' => 'db',
    //             'table' => 'article_spider',
    //         ),
    //         'db_config' => array(
    //             'host'  => '127.0.0.1',
    //             'port'  => 3306,
    //             'user'  => 'root',
    //             'pass'  => '123456',
    //             'name'  => 'stcn_spider',
    //         ),

    //         // 定义爬虫爬取哪些域名下的网页, 非域名下的url会被忽略以提高爬取速度
    //         'domains' => array(
    //             'stcn.com',
    //             'www.stcn.com',
    //         ),
    //         // 定义爬虫的入口链接, 爬虫从这些链接开始爬取,同时这些链接也是监控爬虫所要监控的链接 数组类型 不能为空
    //         'scan_urls' => array(
    //             'http://www.stcn.com/',
    //         ),
    //         // 定义列表页url的规则 对于有列表页的网站, 使用此配置可以大幅提高爬虫的爬取速率 列表页是指包含内容页列表的网页 数组类型 正则表达式 "http://www.qiushibaike.com/8hr/page/\d+\?s=\d+"
    //         'list_url_regexes' => array(
    //             "http://www.stcn.com/article/list/yw.html",
    //             "http://www.stcn.com/article/list/kx.html",
    //             "http://www.stcn.com/article/list/company.html",
    //             "http://www.stcn.com/article/list/gsxw.html",
    //         ),
    //         // 定义内容页url的规则 内容页是指包含要爬取内容的网页数组类型 正则表达式 最好填写以提高爬取效率
    //         'content_url_regexes' => array(
    //             "http://www.stcn.com/article/detail/\d+.html",
    //         ),
    //         // 定义内容页的抽取规则 规则由一个个field组成, 一个field代表一个数据抽取项 数组类型 不能为空
    //         'fields' => array(
    //             array(
    //                 'name' => "title",
    //                 'selector' => "//div[contains(@class,'detail-title')]",
    //                 'selector_type' => 'xpath',
    //                 'required' => true,
    //                 'repeated' => true,
    //                 'children' => array(
    //                     array(
    //                         'name' => "replay",
    //                         'selector' => "//div[contains(@class,'replay')]",
    //                         'repeated' => true,
    //                     ),
    //                     array(
    //                         'name' => "report",
    //                         'selector' => "//div[contains(@class,'report')]",
    //                         'repeated' => true,
    //                     )
    //                 ),

    //                 array(
    //                     'name' => "comment_id",
    //                     'selector' => "//div/@data-aid",
    //                 ),
    //                 array(
    //                     'name' => "comments",
    //                     'source_type' => 'attached_url',
    //                     // "comments"是从发送"attached_url"这个异步请求返回的数据中抽取的
    //                     // "attachedUrl"支持引用上下文中的抓取到的"field", 这里就引用了上面抓取的"comment_id"
    //                     'attached_url' => "https://www.zhihu.com/r/answers/{comment_id}/comments",
    //                     'selector_type' => 'jsonpath',
    //                     'selector' => "$.data",
    //                     'repeated' => true,
    //                 ),
    //             ),
    //         ),
    //     );

    /**
     * 获取所有网站配置信息
     * @return Result
     */
    public static function getWebsiteConfig()
    {
        $retval = new Result();
        $retval->code = ResultCode::SUCCESS;
        $retval->message = '获取数据成功';

        $data = [];

        try {
            $websites = Website::where('status!=0')->order('create_time', 'desc')->select(); // 获取所有有效的网站配置数据
            $websiteFields = WebsiteField::where('status!=0')->whereNull('parent_id')->select(); // 所有字段
            // 所有子字段
            $websiteFields2 = WebsiteField::where('f.status!=0')->whereNull('f.parent_id')->where('f2.status!=0')
                ->alias('f')
                ->field('f2.*')
                ->join('website_field f2', 'f2.parent_id=f.id')
                ->select();

            if (!$websites->isEmpty()) {
                foreach ($websites as $website) {
                    $fieldConfig = []; // 字段
                    if (!$websiteFields->isEmpty()) { // 打包字段
                        $fields = $websiteFields->where('website_id', $website->id); // 取出所有字段
                        if (!$fields->isEmpty()) {
                            foreach ($fields as $field) {
                                $field2Config = [];
                                if (!$websiteFields2->isEmpty()) { // 打包子字段
                                    $fields2 = $websiteFields2->where('parent_id', $field->id); // 字段子集
                                    if (!$fields2->isEmpty()) {
                                        foreach ($fields2 as $field2) {
                                            $fc2 = [
                                                'name' => $field2->name,
                                                'selector' => $field2->selector,
                                                'selector_type' => $field2->selectorType,
                                                'required' => (bool)$field2->required,
                                                // 'repeated' => (bool)$field2->repeated,
                                                // 'source_type' => $field2->sourceType,
                                                // 'attached_url' => $field2->attachedUrl,
                                                // 'is_write_db' => (bool)$field2->isWriteDb,
                                                // 'join_field' => $field2->joinField,
                                                // 'filter' => $field2->filter,
                                            ];
                                            if (!empty($website->repeated)) {
                                                $fc2['repeated'] = (bool)$field->repeated;
                                            }
                                            if (!empty($website->sourceType)) {
                                                $fc2['source_type'] = $field->sourceType;
                                            }
                                            if (!empty($website->attachedUrl)) {
                                                $fc2['attached_url'] = $field->attachedUrl;
                                            }
                                            if (!empty($website->isWriteDb)) {
                                                $fc2['is_write_db'] = (bool)$field->isWriteDb;
                                            }
                                            if (!empty($website->joinField)) {
                                                $fc2['join_field'] = $field->joinField;
                                            }
                                            if (!empty($website->filter)) {
                                                $fc2['filter'] = $field->filter;
                                            }

                                            $field2Config[] = $fc2;
                                        }
                                    }
                                }

                                $fc = [
                                    'name' => $field->name,
                                    'selector' => $field->selector,
                                    'selector_type' => $field->selectorType,
                                    'required' => (bool)$field->required,
                                    // 'repeated' => (bool)$field->repeated,
                                    // 'source_type' => $field->sourceType,
                                    // 'attached_url' => $field->attachedUrl,
                                    // 'is_write_db' => (bool)$field->isWriteDb,
                                    // 'join_field' => $field->joinField,
                                    // 'filter' => $field->filter,
                                ];
                                if (!empty($website->repeated)) {
                                    $fc['repeated'] = (bool)$field->repeated;
                                }
                                if (!empty($website->sourceType)) {
                                    $fc['source_type'] = $field->sourceType;
                                }
                                if (!empty($website->attachedUrl)) {
                                    $fc['attached_url'] = $field->attachedUrl;
                                }
                                if (!empty($website->isWriteDb)) {
                                    $fc['is_write_db'] = (bool)$field->isWriteDb;
                                }
                                if (!empty($website->joinField)) {
                                    $fc['join_field'] = $field->joinField;
                                }
                                if (!empty($website->filter)) {
                                    $fc['filter'] = $field->filter;
                                }
                                if (!empty($field2Config)) {
                                    $fc['children'] = $field2Config;
                                }

                                $fieldConfig[] = $fc;
                            }
                        }
                    }

                    // 网站 如果业务配置此项为空而且配置文件中此项也为空，则不需要此项，因为抓取业务中会用isset来判断是否存在，如果存在值又为空，则有可能出错，所以如果没值干脆没有此项最准确
                    $fds = [
                        'name' => $website->name,
                        'domains' => explode('【', $website->domains ?? ''),
                        'scan_urls' => explode('【', $website->scanUrls ?? ''),
                        'list_url_regexes' => explode('【', $website->listUrls ?? ''),
                        'content_url_regexes' => explode('【', $website->contentUrls ?? ''),

                        'fields' => $fieldConfig,
                    ];

                    // 编码
                    if (!empty($website->inputEncoding)) {
                        $fds['input_encoding'] = $website->inputEncoding;
                    } elseif (!empty(Config::get('spider.input_encoding'))) {
                        $fds['input_encoding'] = (int)Config::get('spider.input_encoding');
                    }

                    if (!empty($website->outputEncoding)) {
                        $fds['output_encoding'] = $website->outputEncoding;
                    } elseif (!empty(Config::get('spider.output_encoding'))) {
                        $fds['output_encoding'] = (int)Config::get('spider.output_encoding');
                    }

                    // 频率相关
                    if (!empty($website->interval)) {
                        $fds['interval'] = $website->interval;
                    } elseif (!empty(Config::get('spider.interval'))) {
                        $fds['interval'] = (int)Config::get('spider.interval');
                    }

                    if (!empty($website->timeout)) {
                        $fds['timeout'] = $website->timeout;
                    } elseif (!empty(Config::get('spider.timeout'))) {
                        $fds['timeout'] = (int)Config::get('spider.timeout');
                    }

                    if (!empty($website->maxTry)) {
                        $fds['max_try'] = $website->maxTry;
                    } elseif (!empty(Config::get('spider.max_try'))) {
                        $fds['max_try'] = (int)Config::get('spider.max_try');
                    }

                    if (!empty($website->maxDepth)) {
                        $fds['max_depth'] = $website->maxDepth;
                    } elseif (!empty(Config::get('spider.max_depth'))) {
                        $fds['max_depth'] = (int)Config::get('spider.max_depth');
                    }

                    if (!empty($website->maxFields)) {
                        $fds['max_fields'] = $website->maxFields;
                    } elseif (!empty(Config::get('spider.max_fields'))) {
                        $fds['max_fields'] = (int)Config::get('spider.max_fields');
                    }

                    // 多服务 多线程 需要redis支持
                    if (!empty($website->tasknum)) {
                        $fds['tasknum'] = $website->tasknum;
                    } elseif (!empty(Config::get('spider.tasknum'))) {
                        $fds['tasknum'] = (int)Config::get('spider.tasknum');
                    }

                    if (!empty($website->multiserver)) {
                        $fds['multiserver'] = (bool)$website->multiserver;
                    } elseif (!empty(Config::get('spider.multiserver'))) {
                        $fds['multiserver'] = (bool)Config::get('spider.multiserver');
                    }

                    if (!empty($website->serverid)) {
                        $fds['serverid'] = $website->serverid;
                    } elseif (!empty(Config::get('spider.serverid'))) {
                        $fds['serverid'] = (int)Config::get('spider.serverid');
                    }

                    if (!empty($website->saveRunningState)) {
                        $fds['save_running_state'] = (bool)$website->saveRunningState;
                    } elseif (!empty(Config::get('spider.save_running_state'))) {
                        $fds['save_running_state'] = (bool)Config::get('spider.save_running_state');
                    }

                    if (!empty(Config::get('spider.queue_config'))) {
                        $fds['queue_config'] = Config::get('spider.queue_config');
                    }

                    // db
                    if (!empty(Config::get('spider.export'))) {
                        $fds['export'] = Config::get('spider.export');
                    }
                    if (!empty(Config::get('spider.db_config'))) {
                        $fds['db_config'] = Config::get('spider.db_config');
                    }

                    // 反爬
                    if (!empty($website->proxy)) {
                        $fds['proxy'] = explode('【', $website->proxy);
                    } elseif (!empty(Config::get('spider.proxy'))) {
                        $fds['proxy'] = Config::get('spider.proxy');
                    }

                    if (!empty($website->clientIp)) {
                        $fds['client_ip'] = explode('【', $website->clientIp);
                    } elseif (!empty(Config::get('spider.client_ip'))) {
                        $fds['client_ip'] = Config::get('spider.client_ip');
                    }

                    if (!empty($website->userAgent)) {
                        $fds['user_agent'] = explode('【', $website->userAgent);
                    } elseif (!empty(Config::get('spider.user_agent'))) {
                        $fds['user_agent'] = Config::get('spider.user_agent');
                    }

                    // logo
                    if (!empty(Config::get('spider.log_show'))) {
                        $fds['log_show'] = (bool)Config::get('spider.log_show');
                    }
                    if (!empty(Config::get('spider.log_type'))) {
                        $fds['log_type'] = Config::get('spider.log_type');
                    }
                    if (!empty(Config::get('spider.log_file'))) {
                        $fds['log_file'] = Config::get('spider.log_file');
                    }

                    $data[] = $fds;
                }
            }

            $retval->result = $data;

            return $retval;
        } catch (\Exception $ex) {
            $retval->code = ResultCode::ERROR;
            $retval->message = "获取数据失败：{$ex->getMessage()}";
            Log::error("{$retval->message}\r\n");
            return $retval;
        }
    }
}
