<?php

if (strtolower(php_sapi_name()) != 'cli') {
    die("请在cli模式下运行");
}

exec("ps aux | grep /www/wwwroot/spider/public/spider.php | grep -v grep | awk '{print $2}' |xargs kill -SIGKILL");