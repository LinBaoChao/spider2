<?php

// +----------------------------------------------------------------------
// | 日志设置
// +----------------------------------------------------------------------
return [
    // 默认日志记录通道
    'default'      => env('log.channel', 'file'),
    // 日志记录级别
    'level'        => [],
    // 日志类型记录的通道 ['error'=>'email',...]
    'type_channel' => [],
    // 关闭全局日志写入
    'close'        => false,
    // 全局日志处理 支持闭包
    'processor'    => null,

    /*'type_channel'    =>    [
        'error'    =>    'email',
        'sql'    =>    'sql',
    ],*/

    // 日志通道列表
    'channels'     => [
        'file' => [
            // 日志记录方式
            'type'           => 'File',
            // 日志保存目录
            'path'           => '',
            // 单文件日志写入
            'single'         =>  false,
            //'file_size'   	 => 	1024*1024*10,
            // 独立日志级别
            'apart_level'    => ['info','debug','notice','warning','error','critical','alert','emergency','sql','trace'],
            // 最大日志文件数量
            'max_files'      => 0,
            // 使用JSON格式记录
            'json'           => false,
            // 日志处理
            'processor'      => null,
            // 关闭通道日志写入
            'close'          => false,
            'time_format'   =>    'Y-m-d H:i:s:m',
            // 日志输出格式化
            'format'         => '[%s][%s] %s',
            // 是否实时写入
            'realtime_write' => true,
        ],
        // 其它日志通道配置

        // 行为日志
        'ActionLog' => [
            // 日志记录方式 '\app\service\LogService' '\app\driver\log\Tp6Log',
            'type'           => 'File',
            // 日志保存目录
            'path'           => runtime_path() . '/log/ActionLog',  //日志存放目录
            // 单文件日志写入
            'single'         =>  false,
            //'file_size'   	 => 	1024*1024*10,
            // 独立日志级别
            'apart_level'    => ['info','debug','notice','warning','error','critical','alert','emergency','sql','trace'],
            // 最大日志文件数量
            'max_files'      => 0,
            // 使用JSON格式记录
            'json'           => true,
            // 日志处理
            'processor'      => null,
            // 关闭通道日志写入
            'close'          => false,
            'time_format'   =>    'Y-m-d H:i:s:m',
            // 日志输出格式化
            'format'         => '[%s][%s] %s',
            // 是否实时写入
            'realtime_write' => true,
        ],

        // LovelyCat日志
        'LovelyCat' => [
            // 日志记录方式
            'type'           => 'File',
            // 日志保存目录
            'path'           => runtime_path().'/log/LovelyCat',  //日志存放目录
            // 单文件日志写入
            'single'         =>  false,
            //'file_size'   	 => 	1024*1024*10,
            // 独立日志级别
            'apart_level'    => ['info','debug','notice','warning','error','critical','alert','emergency','sql','trace'],
            // 最大日志文件数量
            'max_files'      => 0,
            // 使用JSON格式记录
            'json'           => false,
            // 日志处理
            'processor'      => null,
            // 关闭通道日志写入
            'close'          => false,
            'time_format'   =>    'Y-m-d H:i:s:m',
            // 日志输出格式化
            'format'         => '[%s][%s] %s',
            // 是否实时写入
            'realtime_write' => true,
        ],

        // /*'email'    =>    [
        //     'type'    =>    'email',
        // ],
        // 'sql'    =>    [
        //     'type'    =>    'sql',
        // ],*/
        
    ],

];
