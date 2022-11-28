<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2019 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

// [ 应用入口文件 ]
namespace think;

require __DIR__ . '/../vendor/autoload.php';

// 执行HTTP应用并响应 指定环境变量使用名，如环境变量文件名为.env.develop lbc
// $http = (new App())->setEnvName('develop')->http;

// 执行HTTP应用并响应
$http = (new App())->http;

// 获取当前应用app('http')->getName();
// 如果入口文件名与应用名不一致时，则需要指定，如应用名为admin需使用以下指定
// $response = $http->name('admin')->run();
$response = $http->run();

$response->send();

$http->end($response);
