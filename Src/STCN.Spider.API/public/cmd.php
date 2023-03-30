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
4 编辑php配置文件打开扩展，增加行如，如果出现重复加载的提示则不需要加以下
[pcntl]
extension=/www/server/php/81/lib/php/extensions/no-debug-non-zts-20210902/pcntl.so

5 检查是否安装成功 php --ri pcntl
6 安装结束
7 项目需要配置的文件有（若配置文件有变则需要重新运行）：.env .env.develop config下的app.php、database.php、spider.php、queue.php 需要配置的内容有：数据库、redis、api url

运行php文件 /www/server/php/81/bin/php /www/wwwroot/spider/public/spider.php
在后台运行 nohup /www/server/php/81/bin/php /www/wwwroot/spider/public/spider.php &
/www/server/php/81/bin/php /www/wwwroot/spider/public/spidertest.php
ps -ef|grep php
ps -Af|grep php
ps -Af|grep spider.php
killall -9 php
kill -9 PID
ps aux | grep /www/wwwroot/spider/public/spider.php | grep -v grep | awk '{print $2}' |xargs kill -SIGKILL
ps aux | grep /www/wwwroot/spider/public/spidertest.php | grep -v grep | awk '{print $2}' |xargs kill -SIGKILL
ctrl + z：将正在前台执行的命令放到后台，且让命令处于暂停状态。
jobs：查看当前有多少在后台运行的命令，-l选项可显示所有任务的PID。

开端口：firewall-cmd --zone=public --add-port=3306/tcp --permanent
关端口：firewall-cmd --zone=public --remove-port=8080/tcp --permanent
 */