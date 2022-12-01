<?php
require __DIR__ . '/../vendor/autoload.php';

use Beanbun\Beanbun;

$beanbun = new Beanbun;
$beanbun->seed = [
    'http://www.stcn.com/',
    'http://www.stcn.com/article/list/yw.html',
    'http://www.stcn.com/article/detail/\d+.html',
];
$beanbun->afterDownloadPage = function ($beanbun) {
    file_put_contents(__DIR__ . '/' . md5($beanbun->url), $beanbun->page);
};

// 每隔一天重新把首页加入队列
$beanbun->startWorker = function ($beanbun) {
    if ($beanbun->id == 0) {
        Beanbun::timer(86400, function () use ($beanbun) {
            $beanbun->queue()->add('http://www.stcn.com/');
        });
    }
};

$beanbun->start();
