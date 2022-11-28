ThinkPHP 6.0
===============

> 运行环境要求PHP7.2+，兼容PHP8.1

[官方应用服务市场](https://market.topthink.com) | [`ThinkAPI`——官方统一API服务](https://docs.topthink.com/think-api)

ThinkPHPV6.0版本由[亿速云](https://www.yisu.com/)独家赞助发布。

## 主要新特性

* 采用`PHP7`强类型（严格模式）
* 支持更多的`PSR`规范
* 原生多应用支持
* 更强大和易用的查询
* 全新的事件系统
* 模型事件和数据库事件统一纳入事件系统
* 模板引擎分离出核心
* 内部功能中间件化
* SESSION/Cookie机制改进
* 对Swoole以及协程支持改进
* 对IDE更加友好
* 统一和精简大量用法

## 安装

直接composer install 安装
~~~
composer create-project topthink/think tp 6.0.*
~~~

如果需要更新框架使用
~~~
composer update topthink/framework
~~~

## 文档

[完全开发手册](https://www.kancloud.cn/manual/thinkphp6_0/content)

## 参与开发

请参阅 [ThinkPHP 核心框架包](https://github.com/top-think/framework)。

## 版权信息

ThinkPHP遵循Apache2开源协议发布，并提供免费使用。

本项目包含的第三方源码和二进制文件之版权信息另行标注。

版权所有Copyright © 2006-2021 by ThinkPHP (http://thinkphp.cn)

All rights reserved。

ThinkPHP® 商标和著作权所有者为上海顶想信息科技有限公司。

更多细节参阅 [LICENSE.txt](LICENSE.txt)

## tp6备忘

composer create-project topthink/think tp

数据库连接
protected $connection = 'demo';

设置返回数据集的对象名
protected $resultSetType = '\app\common\Collection';
属性用于设置自定义的数据集使用的类名，该类应当继承系统的think\model\Collection类

模型名
protected $name = 'wechat_msg';

数据转换为驼峰命名
protected $convertNameToCamel = true;

模型数据不区分大小写
protected $strict = false,

定义默认的表后缀（默认查询中文数据）
protected $suffix = '_cn';

开启自动写入时间戳字段
protected $autoWriteTimestamp = true;
// 关闭自动写入update_time字段
protected $updateTime = false;
一旦配置开启的话，会自动写入create_time和update_time两个字段的值，默认为整型（int），如果你的时间字段不是int类型的话，可以直接使用：
// 开启自动写入时间戳字段
'auto_timestamp' => 'datetime', 或 protected $autoWriteTimestamp = 'datetime';
如果你的数据表字段不是默认值的话，可以按照下面的方式定义
// 定义时间戳字段名
protected $createTime = 'create_at';
protected $updateTime = 'update_at';
支持动态关闭时间戳写入功能，例如你希望更新阅读数的时候不修改更新时间，可以使用isAutoWriteTimestamp方法如$user->isAutoWriteTimestamp(false)->save();

设置字段自动转换类型
protected $type = [
    'score'       => 'float',
];

设置字段信息
protected $schema = [
    'id'              => 'int',
    'name'            => 'string',
    'alias'           => 'string',
    'sort'             => 'int',
];

设置废弃字段
protected $disuse = [ 'status', 'type' ];

在模型外部获取数据的方法如下
$user = User::find(1);
echo $user->name;

在模型内部获取数据的方法如下
$user = User::find(1);
请不要使用$this->name的方式来获取数据，请使用$this->getAttr('name') 替代。

使用create方法新增数据，使用saveAll批量新增数据
如果需要使用模型事件，那么就先查询后更新，如果不需要使用事件或者不查询直接更新，直接使用静态的Update方法进行条件更新，如非必要，尽量不要使用批量更新
如果删除当前模型数据，用delete方法，如果需要直接删除数据，使用destroy静态方法。
在模型外部使用静态方法进行查询，内部使用动态方法查询，包括使用数据库的查询构造器。

// 定义全局的查询范围
protected $globalScope = ['status'];
// 关闭全局查询范围
User::withoutGlobalScope(['status'])->select();

// 设置json类型字段
protected $json = ['info'];
// 设置JSON字段的类型
protected $jsonType = [
    'info->user_id'	=>	'int'
];
// 设置JSON数据返回数组
protected $jsonAssoc = true;

只读字段用来保护某些特殊的字段值不被更改
protected $readonly = ['name', 'email'];
$user->readonly(['name','email'])->save();

要使用软删除功能，需要引入SoftDelete trait
use SoftDelete;
protected $deleteTime = 'delete_time';属性用于定义你的软删除标记字段
protected $defaultSoftDelete = 0;

支持给字段设置类型自动转换，会在写入和读取的时候自动进行类型转换处理
protected $type = [
        'status'    =>  'integer',
        'score'     =>  'float',
        'birthday'  =>  'datetime', // 'timestamp:Y/m/d'
        'info'      =>  'array',
    ];

return [
    'default'    =>    'mysql',
    'connections'    =>    [
        'mysql'    =>    [
            // 启用分布式数据库
            'deploy'   => 1,
            // 数据库类型
            'type'     => 'mysql',
            // 服务器地址
            'hostname' =>[ '192.168.1.1','192.168.1.2','192.168.1.3'],
            // 数据库名
            'database' => 'demo',
            // 数据库用户名
            'username' => 'root,slave,slave',
            // 数据库密码
            'password' => ['123456','abc,def','hello']
            // 数据库连接端口
            'hostport' => '',
            // 数据库字符集
            'charset'  => 'utf8',
        ],
    ],
];

swagger导出命令
https://blog.csdn.net/qq_38757174/article/details/116301882
./vendor/bin/openapi --output ./public/swagger.json ./app/Controller