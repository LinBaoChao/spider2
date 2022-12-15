<?php
// +----------------------------------------------------------------------
// | Spider配置 当业务配置对应字段为空时会取此配置的相应字段值，如果这个值也是空，则不加此配置项，抓取程序当没有取到相应配置项时也会有默认值 
// +----------------------------------------------------------------------

return [
    // 编码
    'input_encoding' => '', // 输入编码
    'output_encoding' => '', // 输出编码

    // logo
    'log_show' => true, // 是否开启
    'log_type' => 'error,debug,info,warn', // 'error,debug,info,warn' 默认空为所有
    'log_file' => '', // '/../data/log/phpspider.log', // 存放文件路径

    // 频率相关
    'interval' => 1000, // 爬取间隔（毫秒）
    'timeout' => 5, // 爬取超时（秒）
    'max_try' => 5, // 失败重试
    'max_depth' => 0, // 爬取深度,默认值为0，即不限制
    'max_fields' => 0, // 最大内容数,默认值为0，即不限制

    // 多服务 多线程 需要redis支持
    'tasknum' => 3, // 多任务
    'multiserver' => true, // 多服务器
    'serverid' => 1, // 第几台服务器，当业务配置为空时取这个值 
    'save_running_state' => true, // 是否保存运行状态
    // redis
    'queue_config' => array(
        'host'      => '127.0.0.1',
        'port'      => 6379,
        'pass'      => '',
        'db'        => 5,
        'prefix'    => 'phpspider',
        'timeout'   => 30,
    ),

    // db
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
    // clickHouse db
    'click_house' => array(
        'host' => '10.254.15.57',
        'port' => '8123',
        'username' => 'linbaocao',
        'password' => '345556'
    ),

    // 反爬
    'proxy' => array(),
    'client_ip' => array(),
    'user_agent' => array(),

    // api url
    'api_url' => 'http://127.0.0.1:7777/', // 以/结尾

    'is_run_spider' => true, // 运行或停用爬虫程序
    'sleep_seconds' => 60 * 60 * 1, // 单位秒，爬虫轮询周期，一般2小时
];
