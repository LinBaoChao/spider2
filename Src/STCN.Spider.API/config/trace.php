<?php
// +----------------------------------------------------------------------
// | Trace设置 开启调试模式后有效
// +----------------------------------------------------------------------
return [
    // 内置Html和Console两种方式 支持扩展
    'type'    => 'Html', // 这里改成console的话还会出错呵呵 Array to string conversion [\vendor\topthink\think-trace\src\Console.php:147]
    // 读取的日志通道名
    'channel' => '',

    //'file'    =>    'app\trace\page_trace.html',
];

/*
return [
    'type' => 'Html',
    'tabs' => [
        'base'                 => '基本',
        'file'                 => '文件',
        'error|notice|warning' => '错误',
        'sql'                  => 'SQL',
        'debug|info'           => '调试',
    ],
];
*/