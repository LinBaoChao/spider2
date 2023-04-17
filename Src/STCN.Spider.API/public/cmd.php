<?php

if (strtolower(php_sapi_name()) != 'cli') {
    die("请在cli模式下运行");
}

exec("ps aux | grep /www/wwwroot/spider/public/spider.php | grep -v grep | awk '{print $2}' |xargs kill -SIGKILL");

/*
1 安装宝塔
以下地址复制最新版本命令安装 如果不是root用户而有管理权限就在命令前加sudo,否则提示要求用root安装
https://www.bt.cn/btcode.html
如：
yum install -y wget && wget -O install.sh https://download.bt.cn/install/install_6.0.sh && sh install.sh ed8484bec

2 在宝塔中安装Nginx、PHP（安装配置redis扩展）、mysql(若有独立服务器可不装，若是在宝塔中安装在左目录的数据库菜单里进来改root的密码，把mysql库的use表里的root用户的host改为%允许远程访问)、redis(有则不装)
3 装pcntl扩展
参考：
https://blog.csdn.net/jined/article/details/113122709
http://www.findme.wang/blog/detail/id/300.html
开始安装：
进入要存放下载文件的目录如 cd /tools
下载对应的php版本源码 wget -c http://cn.php.net/distributions/php-8.2.4.tar.gz
解压 tar -xzvf php-8.2.4.tar.gz
进入目录 cd /tools/php-8.2.4/ext/pcntl
编译：
1 /www/server/php/82/bin/phpize
2 ./configure --prefix=/www/server/php/81/bin/php --with-php-config=/www/server/php/82/bin/php-config
3 make && make install
4 编辑php配置文件打开扩展，增加行如，如果出现重复加载的提示则不需要加以下
[pcntl]
extension=/www/server/php/82/lib/php/extensions/no-debug-non-zts-20220829/pcntl.so

5 检查是否安装成功 php --ri pcntl
6 安装结束
7 项目需要配置的文件有（若配置文件有变则需要重新运行）：.env .env.develop config下的app.php、database.php、spider.php、queue.php 需要配置的内容有：数据库、redis、api url

8 redis得设置密码及把bind ip改为0.0.0.0才能允许远程访问
9 打开对应的端口
开端口：firewall-cmd --zone=public --add-port=3306/tcp --permanent
关端口：firewall-cmd --zone=public --remove-port=8080/tcp --permanent

10 新建网站和api 运行目录为public 伪静态为thiinkphp
11 新建前端网站纯静态 node安装
11 打开目录权限
chmod -R 777 /www/wwwroot

运行php文件 /www/server/php/82/bin/php /www/wwwroot/spider/public/spider.php
在后台运行 nohup /www/server/php/82/bin/php /www/wwwroot/spider/public/spider.php &
/www/server/php/82/bin/php /www/wwwroot/spider/public/spidertest.php
/www/server/php/82/bin/php /www/wwwroot/spidertest/public/spidertest.php
ps -ef|grep php
ps -Af|grep php
ps -Af|grep spider.php
killall -9 php
kill -9 PID
ps aux | grep /www/wwwroot/spider/public/spider.php | grep -v grep | awk '{print $2}' |xargs kill -SIGKILL
ps aux | grep /www/wwwroot/spider/public/spidertest.php | grep -v grep | awk '{print $2}' |xargs kill -SIGKILL

ctrl + z：将正在前台执行的命令放到后台，且让命令处于暂停状态。
jobs：查看当前有多少在后台运行的命令，-l选项可显示所有任务的PID。

mysql -h10.254.15.33 -uroot -p123456
redis-cli -h 10.200.201.5 -p 6379 -a stcn168

宝塔命令：https://www.bt.cn/btcode.html
 */