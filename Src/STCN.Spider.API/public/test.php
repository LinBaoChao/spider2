<?php

//use think\App;

use think\facade\Request;
use think\helper\Str;

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
