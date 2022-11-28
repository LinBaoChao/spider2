<?php
//require __DIR__ . '/../vendor/autoload.php';

use Beanbun\Lib\Helper;

$href = '/one.html';
$url = 'http://www.beanbun.org/1/2/demo.html';

echo Helper::formatUrl($href, $url);