<?php
// +----------------------------------------------------------------------
// | Token配置
// +----------------------------------------------------------------------

return [
    'type' => 'JWT',
    // 签名私钥
    'key' => '1!2@3$',
    // 接收方 第三方 uid
    'iss' => ['1001' => '123456'],
    // 接收者
    'aud' => 'http://stcn.framework.api',
    // 签名失效时间 - 秒 3600（1小时）
    'expires_in'      => 3600 * 2,
    // 距离签名失效时间多少内可以重置签名- 秒 1800（0.5小时）
    'rest_expires_in' => 1800,
    'alg' => 'HS256',
    // Header头 Token 名称
    'header_token_key' => 'Token', // 前后端要一致
    // 不需要检查token的控制器/方法,小写
    'no_token_list' => ['user/login', 'user/createmd5', 'user/gettoken', 'wechatmsg/list', 'wechatmsg/info', 'wechatmsg/detail', 'wechatmsg/list2'],
    'pattern' => ['swagger', 'apidoc'], // 特殊放行
];