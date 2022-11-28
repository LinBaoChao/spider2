<?php
// 全局中间件定义文件
return [
    // 全局请求缓存
    // \think\middleware\CheckRequestCache::class,
    // 多语言加载
    // \think\middleware\LoadLangPack::class,
    // Session初始化
    // \think\middleware\SessionInit::class,
    // 跨域
    //\think\middleware\AllowCrossDomain::class,
    \app\middleware\AllowCrossDomain::class,
    // 验证token
    //\app\middleware\CheckToken::class, // 只能在路由中加，不能在这加，在这加$request->controller()获取不到
    // 行为日志
    \app\middleware\ActionLog::class, 
];


/*
// 全局中间件定义文件
return [
    // 全局请求缓存
    // \think\middleware\CheckRequestCache::class,
    // 多语言加载
    // \think\middleware\LoadLangPack::class,
    // Session初始化
    // \think\middleware\SessionInit::class

    //app\middleware\Check::class
];

return [
    'alias' => [
        'auth'  => app\middleware\Auth::class,
        'check' => app\middleware\Check::class,
    ],
];

return [
    'alias' => [
        'check' => [
            app\middleware\Auth::class,
            app\middleware\Check::class,
        ],
    ],
];

*/