<?php
require_once __DIR__ . '/../extend/topspider/autoloader.php';

use topspider\core\topspider;
use topspider\core\selector;
use topspider\core\website;
use topspider\core\log;
use topspider\core\util;

ignore_user_abort();
set_time_limit(0);

define('SCRIPT_DIR', __DIR__ . "/../spiderscript");
util::path_exists(SCRIPT_DIR);

// 生成脚本保存到文件及动态引入
$configs = website::getWebsiteConfig();
if (!empty($configs) && $configs['code'] == 'success') {
    $configs = $configs['result'];
    foreach ($configs as $config) {
        try {
            // 回调脚本，把脚本存成一个以媒体标识名为名字的php文件，然后动态包入此文件，即可供上面的回调函数来调用此脚本
            if (isset($config['callback_script']) && !empty($config['callback_script'])) {
                //echo $config['callback_script'];
                $name = $config['name'];
                // 保存到文件
                $dir = SCRIPT_DIR . "/";
                $filename = $dir . $name . '.php';

                $head = <<<STR
                <?php
                require_once __DIR__ . '/../extend/topspider/autoloader.php';
                use topspider\core\\topspider;
                use topspider\core\selector;
                use topspider\core\website;
                use topspider\core\log;
                use topspider\core\util;

                STR;

                //file_put_contents($filename, "<?php", FILE_APPEND | LOCK_EX);
                file_put_contents($filename, $head . $config['callback_script']);
                // 动态包入
                include_once($filename);
            }
        } catch (\Exception $ex) {
            $configstr = var_export($config, true);
            log::add("脚本配置出错：{$ex->getMessage()}\r\n config：{$configstr}\r\n", 'spiderScriptErr');
        }
    }
}
// ---------------------------------------
