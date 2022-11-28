<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: yunwuxin <448901948@qq.com>
// +----------------------------------------------------------------------

return [
	'default'     => 'database',
	'connections' => [
		'sync'     => [
			'type' => 'sync',
		],
		'database' => [
			'type'       => 'database',
			// 默认队列名，对应mysql表中的queue字段，对应 Queue::push() 的第三个参数
			'queue'      => 'default',
			// 队列表名
			'table'      => 'queue-job',
			// connection配置的是连接名，必须是字符串。
			// 对应 config.database.connections 中的连接名
			// 要注意 对env的修改，如果配置写在了 .env.development 中
			// 则需要修改 /think 文件，保持跟 /public/index.php 一致
			'connection' => 'mysql',
		],
		'redis'    => [
			'type'       => 'redis',
			'queue'      => 'default',
			'host'       => '127.0.0.1',
			'port'       => 6379,
			'password'   => '',
			'select'     => 0,
			'timeout'    => 0,
			'persistent' => false,
		],
	],
	'failed'      => [
		'type'  => 'none',
		'table' => 'failed_jobs',
	],
];
