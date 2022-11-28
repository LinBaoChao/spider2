<?php

namespace app\controller;

use think\helper\Str;
use app\BaseController;
use think\facade\Config;
use think\facade\Log;
use think\facade\Route;

class IndexController extends BaseController
{
    public function index()
    {
        return '<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} a{color:#2E5CD5;cursor: pointer;text-decoration: none} a:hover{text-decoration:underline; } body{ background: #fff; font-family: "Century Gothic","Microsoft yahei"; color: #333;font-size:18px;} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.6em; font-size: 42px }</style><div style="padding: 24px 48px;"> <h1>:) </h1><p> ThinkPHP V' . \think\facade\App::version() . '<br/><span style="font-size:30px;">14载初心不改 - 你值得信赖的PHP框架</span></p><span style="font-size:25px;">[ V6.0 版本由 <a href="https://www.yisu.com/" target="yisu">亿速云</a> 独家赞助发布 ]</span></div><script type="text/javascript" src="https://tajs.qq.com/stats?sId=64890268" charset="UTF-8"></script><script type="text/javascript" src="https://e.topthink.com/Public/static/client.js"></script><think id="ee9b1aa918103c4fc"></think>';
    }

    public function hello($name = 'ThinkPHP6')
    {
        return 'hello,' . $name;
    }

    public function test()
    {
        echo url('index/blog/read', ['id' => 5])
            ->suffix('html')
            ->domain(true)
            ->root('/index.php');

        echo Route::buildUrl();
        echo Route::buildUrl('index/blog/read', ['id' => 5])->suffix('shtml')->domain(true);

        Route::buildUrl('index/blog/read#anchor@blog', ['id' => 5]);
        return;

        echo Str::lower("EEFDSAEWQAdeq4342e#T");
        Log::debug("test");
        echo stripos('aerewqrHTtps://ddddewqrewfdsa', 'https://');
        return;
        return Config::class . ':/admin/v1/roles:delete';

        dump(Config::get('app.default_timezone'));
        return;

        //return Str::lower("EEFDSAEWQAdeq4342e#T");

        // 获取指定长度的随机字母数字组合的字符串
        print(Str::random($length = 16));
        print("<br>");
        echo "<br>";
        // 字符串转小写
        print(Str::lower("EEFDSAEWQAdeq4342e#T"));
        return;
    }

    public function test2()
    {
        $user = User::where(['id' => 3])->findOrEmpty();
        var_dump(($user));
        if (!$user->roles->isEmpty()) {
            var_dump($user->roles[0]);
        }

        $menus = Menu::where('1=1')->order('order_no', 'asc')->select();
        // var_dump($menus);
        if ($menus->isEmpty()) { // 得是isEmpty()方法
            var_dump('empty');
        }
        var_dump(count($menus));
        //var_dump(count($menus));

        // $t = $menus->where('id',2);
        // var_dump($t[0]->menuName); // [0]会出错
        // var_dump($t[0]);

        $m1 = $menus->where('menuCode', 'Sys'); // 这里用menu_code或menuCode都可以
        if ($m1->isEmpty()) {
            var_dump('$m1 empty');
        }
        var_dump(count($m1));
        var_dump($m1);
        $parent = Menu::where('parent_id', 1)->findOrEmpty();
        var_dump($parent);
        if ($parent->isEmpty()) { // 得是isEmpty()方法
            var_dump('empty2');
        }
        echo count($parent); // 这里会报错，count的参数得是集合
        $parent = Menu::where('id', 999)->find();
        var_dump($parent);
        if (empty($parent)) {
            var_dump('empty3');
        }
        if ($parent->isEmpty()) { // 没数据时返回空所以这里会出错因为null没有isEmpty属性
            var_dump('empty4');
        }
        //echo count($parent); // count(): Argument #1 ($value) must be of type Countable|array, app\model\Menu given
        var_dump('2');
        // $m1 = $menus
    }
}
