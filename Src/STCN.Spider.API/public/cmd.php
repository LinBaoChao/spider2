<?php

if (strtolower(php_sapi_name()) != 'cli') {
    die("请在cli模式下运行");
}

exec("ps aux | grep /www/wwwroot/spider/public/spider.php | grep -v grep | awk '{print $2}' |xargs kill -SIGKILL");

/*
1 安装宝塔
以下地址复制最新版本命令安装
https://www.bt.cn/btcode.html
如：
yum install -y wget && wget -O install.sh https://download.bt.cn/install/install_6.0.sh && sh install.sh ed8484bec

2 在宝塔中安装Nginx、PHP-8.1.13（安装配置redis扩展）、mysql(若有独立服务器可不装)、redis(有则不装)
3 装pcntl扩展
参考：
https://blog.csdn.net/jined/article/details/113122709
http://www.findme.wang/blog/detail/id/300.html
开始安装：
进入要存放下载文件的目录如 cd /tools
下载对应的php版本源码 wget -c http://cn.php.net/distributions/php-8.1.13.tar.gz
解压 tar -xzvf php-8.1.13.tar.gz
进入目录 cd /tools/php-8.1.13
编译：
1 /www/server/php/81/bin/phpize
2 ./configure --prefix=/www/server/php/81/bin/php --with-php-config=/www/server/php/81/bin/php-config
3 make && make install
编辑php配置文件打开扩展，增加行如
[pcntl]
extension=/www/server/php/81/lib/php/extensions/no-debug-non-zts-20210902/pcntl.so

检查是否安装成功 php --ri pcntl
安装结束

运行php文件 /www/server/php/81/bin/php /www/wwwroot/spider/public/spider.php
在后台运行 nohup /www/server/php/81/bin/php /www/wwwroot/spider/public/spider.php &
ps -ef|grep php
ps -Af|grep php
ctrl + z：将正在前台执行的命令放到后台，且让命令处于暂停状态。
jobs：查看当前有多少在后台运行的命令，-l选项可显示所有任务的PID。
 */