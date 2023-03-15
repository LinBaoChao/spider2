<?php
require_once __DIR__ . '/../extend/topspider/autoloader.php';

use topspider\core\topspider;
use topspider\core\selector;
use topspider\core\website;
use topspider\core\log;
use topspider\core\util;

const NEWLINE = "\n\n";

function testpcntl()
{
    if (strtolower(php_sapi_name()) != 'cli') {
        die("请在cli模式下运行");
    }

    echo "当前进程：" . getmypid() . NEWLINE;

    $configs = website::getWebsiteConfig();
    if (!empty($configs) && $configs['code'] == 'success') {
        $configs = $configs['result'];
        foreach ($configs as $config) {
            $pid = pcntl_fork(); //fork出子进程

            //fork后父进程会走自己的逻辑，子进程从处开始走自己的逻辑，堆栈信息会完全复制给子进程内存空间，父子进程相互独立
            $name = $config['name'];
            if ($pid == -1) { // 创建错误，返回-1
                echo '{$name}进程fork失败' . NEWLINE;
            } else if ($pid == 0) {
                runSpider($name);
            }
        }
    }
}

function runSpider($name)
{
    $i = 1;
    while (1) {
        // 子进程逻辑
        $time = microtime(true);
        echo "{$name}子进程第{$i}次运行，{$time}" . NEWLINE;
        $i++;
        sleep(60);
    }
}

///=======================
function daemon($func_name)
{
    $args = func_get_args();
    unset($args[0]);
    $pid = pcntl_fork();
    if ($pid) {
        pcntl_wait($status);
    } else if ($pid == -1) {
        echo "Couldn't create child process.";
    } else {
        $pid = pcntl_fork();
        if ($pid == 0) {
            posix_setsid();
            function_exists($func_name) and exit(call_user_func_array($func_name, $args)) or exit(-1);
        } else if ($pid == -1) {
            echo "Couldn’t create child process.";
        } else {
            sleep(5);
            exit;
        }
    }
}

function test()
{
    while ($i++ < 10) {
        echo "child process $i/n";
        sleep(1);
    }
}

daemon("test");
while (++$j) echo "parent process $j/n";
