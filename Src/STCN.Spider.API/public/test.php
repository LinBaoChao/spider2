<?php
use phpspider\core\selector;
use think\helper\Str;
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

$url = "http://finance.ynet.com/2022/07/15/3494804t632.html";
$data = website::httpRequest($url);
var_dump($data);
$data = selector::select($data, "//span[contains(@class,'timeMsg')]");
var_dump($data);

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

// var_dump(preg_match("php/i", "PHP is the web scripting language of choice."));
// var_dump(str_replace('/dd/u', '', "作者：李三无作者：dd"));
// var_dump(preg_replace("",'', '作者：李三无作者：ee'));

// switch('b'){
//     case 'a':
//     case 'b':
//     case 'c':
//         var_dump('abc');
//         break;
//     default:
//         var_dump('111');
// }

$sear = <<<STR
            <div class="social-bar">
              <div class="tt">点赞</div>
              <div class="like like-btn " data-id="757276" data-url="/operation/like.html"/>
              <div class="fav post-btn " data-id="757276" data-url="/operation/collect.html"/>
              <a class="comment" href="#comment"/>
              <div class="tt">分享</div>
              <div class="share-popup social-share" data-initialized="true" data-title="&#x76CA;&#x751F;&#x80A1;&#x4EFD;&#xFF1A;&#x603B;&#x4F53;&#x9884;&#x5224;&#xFF0C;&#x660E;&#x5E74;&#x7956;&#x4EE3;&#x8089;&#x79CD;&#x9E21;&#x7684;&#x5F15;&#x79CD;&#x91CF;&#x4E0D;&#x4F1A;&#x592A;&#x591A;" data-description="&#x76CA;&#x751F;&#x80A1;&#x4EFD;&#xFF1A;&#x603B;&#x4F53;&#x9884;&#x5224;&#xFF0C;&#x660E;&#x5E74;&#x7956;&#x4EE3;&#x8089;&#x79CD;&#x9E21;&#x7684;&#x5F15;&#x79CD;&#x91CF;&#x4E0D;&#x4F1A;&#x592A;&#x591A;" data-image="" data-url="https://h5.stcn.com/pages/detail/detail?id=757276&amp;jump_type=fast_info">
                <a class="social-share-icon icon-wechat wx"/>
                <a class="social-share-icon icon-qzone qq"/>
                <a class="social-share-icon icon-weibo wb"/>
              </div>
            </div>
STR;

$html = <<<STR
            <div class="social-bar">
              <div class="tt">点赞</div>
              <div class="like like-btn " data-id="757276" data-url="/operation/like.html"/>
              <div class="fav post-btn " data-id="757276" data-url="/operation/collect.html"/>
              <a class="comment" href="#comment"/>
              <div class="tt">分享</div>
              <div class="share-popup social-share" data-initialized="true" data-title="益生股份：总体预判，明年祖代肉种鸡的引种量不会太多" data-description="益生股份：总体预判，明年祖代肉种鸡的引种量不会太多" data-image="" data-url="https://h5.stcn.com/pages/detail/detail?id=757276&amp;jump_type=fast_info">
                <a class="social-share-icon icon-wechat wx"/>
                <a class="social-share-icon icon-qzone qq"/>
                <a class="social-share-icon icon-weibo wb"/>
              </div>
            </div>
            <div class="detail-content">
                                <p style="text-indent:0"><script src="https://static-web.stcn.com/static/scripts/echarts.min.js"/>证券时报e公司讯，益生股份在机构调研时表示，据公司了解，今年11月份，我国没有进口祖代肉种鸡，截至目前，12月份只有公司进口了2万套祖代肉种鸡，1-11月份，我国祖代肉种鸡的更新量同比下降30%多，因美国安伟捷公司的供种计划比较紧张，明年一季度的引种情况还要看影响引种的不利因素是否缓解或者消除，总体预判，明年的引种量不会太多。</p>                            </div>
                          <div class="detail-content-editor">责任编辑： 郑灶金</div>
                        <div class="detail-content-tags">
                <!--普通文章标签-->
                                <!--快讯标签-->
            </div>
            <div class="stock-tags">
                              <div>
                                    <a href="/quotes/index/sz002458.html" target="_blank">
                                    <span>SZ</span>
                  <span>益生股份</span>
                  <span class="red fetch-stock-tag-data" data-code="002458"/>
                  </a>
                </div>
                          </div>
                        <div class="detail-content-statement">
                <div>声明：证券时报力求信息真实、准确，文章提及内容仅供参考，不构成实质性投资建议，据此操作风险自担</div>
                <div>下载“证券时报”官方APP，或关注官方微信公众号，即可随时了解股市动态，洞察政策信息，把握财富机会。</div>
            </div>
                        <div class="comment" id="comment">
                <div class="comment-tt">网友评论</div>
                <div class="comment-input">
                                        <div class="ds-tip"><span login-btn="">登录</span>后可以发言</div>
                    <textarea name="content" placeholder="请输入内容" class="hidden"/>
                                        <div class="btn send-comment-btn" data-url="/operation/submit-comment.html?table=news&amp;id=757276" data-id="757276">发送</div>
                </div>
                <div class="comment-tip">网友评论仅供其表达个人看法，并不表明证券时报立场</div>
                <div class="comment-list">
                                        <div class="empty comment text-center" style="display: block">
                      暂无评论
                    </div>
                                    </div>
            </div>
                        <div class="list-page-tab black">
                <div class="active">为你推荐</div>
            </div>
            <ul class="list" data-fetch="true" data-url="">
                                <li class="no-tag ">
                    <div class="content">
                        <div class="tt">
                            <a href="/article/detail/757239.html" target="_blank">
                            重磅会议召开，A股如何应对？市场孕育哪些机会？来看最新解读                            </a>
                        </div>
                        <div class="info mt-60">
                            <span>券商中国</span>
                                                        <span>詹晨</span>
                                                        <span>2022-12-18 14:55</span>
                        </div>
                    </div>
                                        <div class="side">
                        <a href="/article/detail/757239.html" target="_blank">
                            <img src="https://static-web.stcn.com/upload/wechat/20221218/639eb8c3c2247.png" alt=""/>
                        </a>
                    </div>
                                    </li>
                                <li class="no-tag ">
                    <div class="content">
                        <div class="tt">
                            <a href="/article/detail/757228.html" target="_blank">
                            高位买百亿私募产品，反弹了，居然还亏好多？                            </a>
                        </div>
                        <div class="info mt-60">
                            <span>中国基金报</span>
                                                        <span>吴君</span>
                                                        <span>2022-12-18 12:55</span>
                        </div>
                    </div>
                                        <div class="side">
                        <a href="/article/detail/757228.html" target="_blank">
                            <img src="https://static-web.stcn.com/upload/202208/stcn_news_media/W020220809839268524041.png" alt=""/>
                        </a>
                    </div>
                                    </li>
                                <li class="no-tag ">
                    <div class="content">
                        <div class="tt">
                            <a href="/article/detail/757233.html" target="_blank">
                            北上资金连续六周净流入，持续看好大消费板块，这些高人气股获资金抢筹                            </a>
                        </div>
                        <div class="info mt-60">
                            <span>数据宝</span>
                                                        <span>张智博</span>
                                                        <span>2022-12-18 13:18</span>
                        </div>
                    </div>
                                        <div class="side">
                        <a href="/article/detail/757233.html" target="_blank">
                            <img src="https://static-web.stcn.com/upload/wechat/20221218/639ea1f8b1f64.png" alt=""/>
                        </a>
                    </div>
                                    </li>
                                <li class="no-tag ">
                    <div class="content">
                        <div class="tt">
                            <a href="/article/detail/757186.html" target="_blank">
                            "她力量"崛起！3000份问卷揭示女性理财面面观！如何提供有温度服务？这家券商给出答案                            </a>
                        </div>
                        <div class="info mt-60">
                            <span>券商中国</span>
                                                        <span>奚艾思</span>
                                                        <span>2022-12-18 08:51</span>
                        </div>
                    </div>
                                        <div class="side">
                        <a href="/article/detail/757186.html" target="_blank">
                            <img src="https://static-web.stcn.com/upload/wechat/20221218/639e6084f289b.png" alt=""/>
                        </a>
                    </div>
                                    </li>
                                <li class="no-tag ">
                    <div class="content">
                        <div class="tt">
                            <a href="/article/detail/757268.html" target="_blank">
                            中央重磅定调！刚刚，超万字最新解读                            </a>
                        </div>
                        <div class="info mt-60">
                            <span>中国基金报</span>
                                                        <span>曹雯璟 莫琳</span>
                                                        <span>2022-12-18 17:14</span>
                        </div>
                    </div>
                                        <div class="side">
                        <a href="/article/detail/757268.html" target="_blank">
                            <img src="https://static-web.stcn.com/upload/wechat/20221218/639ed8b44e4da.png" alt=""/>
                        </a>
                    </div>
                                    </li>
                                <li class="no-tag ">
                    <div class="content">
                        <div class="tt">
                            <a href="/article/detail/757194.html" target="_blank">
                            明年二季度经济有望出现大幅反弹、防范化解房地产市场风险是重中之重…权威人士解读中央经济工作会议精神                            </a>
                        </div>
                        <div class="info mt-60">
                            <span>e公司</span>
                                                        <span>江聃</span>
                                                        <span>2022-12-18 09:04</span>
                        </div>
                    </div>
                                        <div class="side">
                        <a href="/article/detail/757194.html" target="_blank">
                            <img src="https://static-web.stcn.com/upload/wechat/20221218/639e643d7ac20.png" alt=""/>
                        </a>
                    </div>
                                    </li>
                            </ul>
STR;

// var_dump(strpos($html, $sear));
// var_dump(str_replace($sear, '', $html));

// $a = ['a' => 'a1', 'b' => 'b1', 'c' => 3];
// var_dump($a);
// unset($a['b']);
// var_dump($a);

// $str = explode("|no|", "dwq脸|no|e肝ewq");
// var_dump(sprintf('%01dd', 'ffff'));
 
// $regex= "https://www.bjnews.com.cn/guoji/\d+.html";
// $url = "https://www.bjnews.com.cn/guoji/4324324321.html";
// var_dump(preg_match("#{$regex}#i", $url));
