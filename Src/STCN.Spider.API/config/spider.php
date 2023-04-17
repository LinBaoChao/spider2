<?php
// +----------------------------------------------------------------------
// | Spider配置 当业务配置对应字段为空时会取此配置的相应字段值，如果这个值也是空，则不加此配置项，抓取程序当没有取到相应配置项时也会有默认值 
// +----------------------------------------------------------------------

return [
    // 编码
    'input_encoding' => '', // 输入编码
    'output_encoding' => '', // 输出编码

    // logo
    'log_show' => false, // 是否开启
    'log_type' => 'error,Error,debug,Debug,warn,Warning,task,runspider,joinfields,channel,pubtime,required,spidertest,api', // 'error,Error,debug,Debug,warn,Warning,task,runspider,joinfields,channel,pubtime,required,spidertest,fields,api' 默认空为所有
    'log_file' => '', // '/../data/log/topspider.log', // 存放文件路径

    // 频率相关
    'interval' => 3000, // 爬取间隔（毫秒），此值不配默认为100毫秒
    'timeout' => 5, // 爬取超时（秒）
    'max_try' => 5, // 失败重试
    'max_depth' => 3, // 爬取深度,默认值为0，即不限制
    'max_fields' => 0, // 最大内容数,默认值为0，即不限制

    // 多服务 多线程 需要redis支持
    'tasknum' => 3, // 多任务
    'multiserver' => true, // 多服务器
    'serverid' => 1, // 第几台服务器，当业务配置为空时取这个值 
    'save_running_state' => true, // 是否保存运行状态
    // redis 阿里云服务器
    // 'queue_config' => array(
    //     'host'      => '172.18.56.105',
    //     'port'      => 6379,
    //     'pass'      => 'redis1010',
    //     'db'        => 5,
    //     'prefix'    => 'topspider',
    //     'timeout'   => 30,
    //     // 'queue_order' => 'rand', 此项先不配，默认为列表采集
    // ),
    // redis test
    'queue_config' => array(
        'host'      => '10.200.201.5',
        'port'      => 6379,
        'pass'      => 'stcn168',
        'db'        => 1,
        'prefix'    => 'topspider',
        'timeout'   => 30,
        // 'queue_order' => 'rand', 此项先不配，默认为列表采集
    ),

    // db
    'export' => array(
        'type' => 'api', // csv、sql、db、clickhouse、api
        'table' => 'article_spider',
        'file' => 'export_file',
    ),
    // 以上type用api的话此配置无效，因为通过api写
    'db_config' => array(
        'host'  => '10.200.201.5',
        'port'  => 3306,
        'user'  => 'root',
        'pass'  => '123456',
        'name'  => 'stcn_spider',
    ),
    // clickHouse db 
    // 'click_house' => array(
    //     'host' => 'cc-wz9mfwjh6aa64dl77.public.clickhouse.ads.aliyuncs.com', // '10.254.15.57'
    //     'port' => '8123',
    //     'username' => 'stcn_influence_dev', // 'linbaocao',
    //     'password' => 'NC95XPRyzodLuvB', // '345556',
    //     'dbname' => 'sentiment_dbd', // 'sentiment_db',
    //     'table' => 'sentiment_new_distributed', // 'sentiment_tmp sentiment_t sentiment_t_distributed sentiment_new_distributed',
    // ),
    // test
    'click_house' => array(
        // 'host' => '10.254.15.57',
        // 'port' => '8123',
        // 'username' => 'linbaocao',
        // 'password' => '345556',
        // 'dbname' => 'sentiment_db',
        // 'table' => 'sentiment_new_distributed', // 'sentiment_tmp sentiment_t sentiment_t_distributed sentiment_new_distributed',
    ),

    // 反爬
    'proxy' => array(
        // 'http://user:pass@host:port',
        // 'http://host:port',
        // 'tcp://192.168.0.2:3128',
    ),
    'client_ip' => array(
        '10.254.15.58',
        '10.254.15.34',
        '10.254.15.1',
        '10.254.15.2',
        '10.254.15.3',
        '10.254.15.4',
        '10.254.15.5',
        '10.254.15.6',
        '10.254.15.7',
        '10.254.15.8',
    ),
    'user_agent' => array(
        "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.139 Safari/537.36",
        "Mozilla/5.0 (iPhone; CPU iPhone OS 9_3_3 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13G34 Safari/601.1",
        "Mozilla/5.0 (Linux; U; Android 6.0.1;zh_cn; Le X820 Build/FEXCNFN5801507014S) AppleWebKit/537.36 (KHTML, like Gecko)Version/4.0 Chrome/49.0.0.0 Mobile Safari/537.36 EUI Browser/5.8.015S",
    ),

    // api url
    'api_url' => 'http://127.0.0.1:7777/', // 以/结尾

    // 程序控制
    'is_run_spider' => true, // 运行或停用爬虫程序
    'sleep_seconds' => 60 * 5, // 单位秒，爬虫轮询周期，一般半小时
];
