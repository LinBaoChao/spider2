<?php
var_dump(__DIR__);
require_once __DIR__ . '/../vendor/autoload.php';
//include_once __DIR__ . '/../include.php';

//$config = include_once __DIR__ . '/00_config_connect.php';

 use ClickHouseDB\Client;

// function GUID()
// {
//     if (function_exists('com_create_guid') === true) {
//         return trim(com_create_guid(), '{}');
//     }

//     return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
// }

// // var_dump(GUID());

$config = array(
    'host' => '10.254.15.57',
    'port' => '8123',
    'username' => 'linbaocao',
    'password' => '345556',
    'dbname' => 'sentiment_db',
    'table' => 'sentiment_tmp',
    'auth_method' => 1, // On of HTTP::AUTH_METHODS_LIST
);

$db = new Client($config);
$db->database('sentiment_db');

//var_dump($db);
// $stat = $db->insert(
//     'sentiment_tmp',
//     [
//         [GUID(), 'test1', 'test2', 'test3', 'test4']
//     ],
//     ['id', 'source_title', 'source_content', 'source_url', 'source_name']
// );

// var_dump($stat);

//$db->verbose();
//$db->settings()->readonly(false);
var_dump($db->showTables());

// $result = $db->select("SELECT * FROM sentiment_tmp LIMIT 100");
// print_r($result->fetchOne());

require_once __DIR__ . '/../extend/phpspider/autoloader.php';

use phpspider\core\log;
use phpspider\core\website;
// $config = require_once __DIR__ . '/../config/spider.php';

// var_dump($config['is_run_spider']);

// $r = website::getWebsiteConfig();
// var_dump($r['result'][0]['domains']);
// var_dump($r);

// require_once __DIR__ . '/../vendor/autoload.php';

// use think\facade\Log;

// Log::info("dddd");

//require './vendor/autoload.php';
// GitHub下载方式
//require_once __DIR__ . '/../autoloader.php';

//require __DIR__ . "/index.php";
//require __DIR__ . "/router.php";

// require_once __DIR__ . '/../vendor/autoload.php';
// //require_once __DIR__ . '/../think';
// require __DIR__ . '/../app/service/WebsiteService.php';

// use think\helper\Str;

// use app\model\Website;
// use app\service\WebsiteService;
// use think\facade\Log;

// Log::info("dddd");
// 调用test2可以
//var_dump(WebsiteService::test2());

// 在public的test.php中直接调用则会出错
// $config = WebsiteService::test();
// var_dump($config);

// 或直接通过model操作也会出错如下
// $r = Website::select();
// var_dump($r);

// 关闭错误报告
//error_reporting(0);

// 报告 runtime 错误
//error_reporting(E_ERROR | E_WARNING | E_PARSE);

// 报告所有错误
error_reporting(E_ALL);

// 等同 error_reporting(E_ALL);
//ini_set("error_reporting", E_ALL);

// 报告 E_NOTICE 之外的所有错误
//error_reporting(E_ALL & ~E_NOTICE);

// $a = $_REQUEST['a'];
// $b = $_REQUEST['b'];

// if (isset($a) && isset($b)) {
//     echo "$a + $b = " . add($a, $b);
// } else {
//     echo "www.sqlsec.com";
// }

// function add($x, $y)
// {
//     $total = $x + $y;
//     return $total;
// }

// // print("eeeeeee");
// // print(Str::random(16));
// //         print("<br>");
// // echo "<br>";
// //         // 字符串转小写
// //         print(Str::lower("EEFDSAEWQAdeq4342e#T"));

// // phpinfo();

// $array1 = [
//     'c2' => 'ccc',
//     'a1' => 'aaa',
//     'b1' => 'bbb'
// ];

// $array2 = [
//     'c2' => 'ccc',
//     'a2' => 'aaa',
//     'b2' => 'bbb2'
// ];

// $result = array_intersect_assoc($array1, $array2);

// var_dump($result);


// function test()
// {
//     $add = [];
//     $add[] = ['role_id' => 1, 'permission_id' => 5];
//     $add[] = ['role_id' => 2, 'permission_id' => 4];

//     $s = ["role_id" => 2];
//     $rel = check_user($add, $s);
//     var_dump($rel);
// }

// function check_user($arr, $s)
// {
//     foreach ($arr as $item) {
//         $assoc = array_intersect_assoc($item, $s);
//         if (!empty($assoc)) {
//             return true;
//         }
//     }

//     return false;
// }

// test();
// echo str_replace("\\", "/", "http://10.254.15.33:9997/storage/upload/user-avatar/2022\1119\476dae523fa1653365\8a5040065a2961.png");

// // //var_dump(phpinfo());
// // ,http://www.stcn.com/article/list/kx.html,http://www.stcn.com/article/list/company.html,http://www.stcn.com/article/list/gsxw.html
// $s = '{"a":"2"}'; //["a","b"]
// var_dump($s);
// var_dump(json_decode($s, false)); // stdClass
// $js = json_decode($s, true); // array
// var_dump($js);
// var_dump(json_encode($js));
// var_dump(json_decode('', true));

// $s = '{"a":"http://www.stcn.com/article/detail/\d+.html"}';
// var_dump(htmlspecialchars_decode($s));
// var_dump(json_decode(htmlspecialchars_decode($s), true));

// $s = stripslashes($s);
// var_dump($s);
// var_dump(json_decode($s, true));

// $s = 'a【】b【】c';
// var_dump(explode("【】", $s));

// $config = WebsiteService::test();
// var_dump($config);

// $config = WebsiteService::getWebsiteConfig();
// var_dump(json($config));

// log::$log_show = false;
// $msg = var_export($data, true);
// log::add('$msg', 'debug');
// log::add("var_export($config, true)", 'info');

var_dump(preg_match("php/i", "PHP is the web scripting language of choice."));
var_dump(str_replace('/dd/u', '', "作者：李三无作者：dd"));
var_dump(preg_replace("",'', '作者：李三无作者：ee'));