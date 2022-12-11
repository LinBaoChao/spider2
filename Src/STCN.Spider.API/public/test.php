<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../app/service/WebsiteService.php';
//use think\App;

use think\facade\Request;
use think\helper\Str;

use app\service\WebsiteService;

error_reporting(0);
$a = $_REQUEST['a'];
$b = $_REQUEST['b'];

if (isset($a) && isset($b)) {
    echo "$a + $b = " . add($a, $b);
} else {
    echo "www.sqlsec.com";
}

function add($x, $y)
{
    $total = $x + $y;
    return $total;
}

// print("eeeeeee");
// print(Str::random(16));
//         print("<br>");
// echo "<br>";
//         // 字符串转小写
//         print(Str::lower("EEFDSAEWQAdeq4342e#T"));

// phpinfo();

$array1 = [
    'c2' => 'ccc',
    'a1' => 'aaa',
    'b1' => 'bbb'
];

$array2 = [
    'c2' => 'ccc',
    'a2' => 'aaa',
    'b2' => 'bbb2'
];

$result = array_intersect_assoc($array1, $array2);

var_dump($result);


function test()
{
    $add = [];
    $add[] = ['role_id' => 1, 'permission_id' => 5];
    $add[] = ['role_id' => 2, 'permission_id' => 4];

    $s = ["role_id" => 2];
    $rel = check_user($add, $s);
    var_dump($rel);
}

function check_user($arr, $s)
{
    foreach ($arr as $item) {
        $assoc = array_intersect_assoc($item, $s);
        if (!empty($assoc)) {
            return true;
        }
    }

    return false;
}

test();
echo str_replace("\\", "/", "http://10.254.15.33:9997/storage/upload/user-avatar/2022\1119\476dae523fa1653365\8a5040065a2961.png");

// //var_dump(phpinfo());
// ,http://www.stcn.com/article/list/kx.html,http://www.stcn.com/article/list/company.html,http://www.stcn.com/article/list/gsxw.html
$s = '{"a":"2"}'; //["a","b"]
var_dump($s);
var_dump(json_decode($s, false)); // stdClass
$js = json_decode($s, true); // array
var_dump($js);
var_dump(json_encode($js));
var_dump(json_decode('', true));

$config = WebsiteService::getWebsiteConfig();
var_dump($config);

$s = '{"a":"http://www.stcn.com/article/detail/\d+.html"}';
var_dump(htmlspecialchars_decode($s));
var_dump(json_decode(htmlspecialchars_decode($s), true));

$s = stripslashes($s);
var_dump($s);
var_dump(json_decode($s, true));

$s = 'a【】b【】c';
var_dump(explode("【】", $s));