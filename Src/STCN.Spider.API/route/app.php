<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\facade\Route;
use OpenApi\Generator;

Route::get('User/gettoken', 'User/getToken');
Route::get('gettoken', 'User/getToken');

Route::get('info', 'wechatmsg/info');
Route::get('wechatmsg/info', 'wechatmsg/info');

// 当访问127.0.0.1/swagger时，会自动使用该闭包路由，执行里面的闭包函数
// $openapi = OpenApi\scan(root_path().'app');
Route::get('/apidoc', function() {
    $openapi = Generator::scan([
        '../app/controller',
        //'../app/apiweb/controller',
    ]);
    header('Content-Type: application/json');
    echo $openapi->toJson();
});
Route::get('/swagger', function() {
    $openapi = Generator::scan([
        '../app/controller',
        //'../app/apiweb/controller',
    ]);
    header('Content-Type: application/json');
    echo $openapi->toJson();
});

// Route::get('think', function () {
//     return 'hello,ThinkPHP6!';
// });

// Route::get('hello/:name', 'index/hello');

// Route::group('hello', function () {
//     Route::rule('hello/:name', 'hello');
// })->middleware(function ($request, \Closure $next) {
//     if ($request->param('name') == 'think') {
//         return redirect('index/think');
//     }

//     return $next($request);
// });