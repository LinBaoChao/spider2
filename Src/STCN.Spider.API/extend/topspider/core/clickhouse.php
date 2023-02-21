<?php

namespace topspider\core;

require_once __DIR__ . '../../../phpclickhouse/include.php';
//require_once __DIR__ . '/../vendor/autoload.php';

use ClickHouseDB\Client;
use topspider\core\log;
use topspider\core\util;

class clickhouse
{
    public static function connect($config = null)
    {
        if (empty($config)) {
            $spiderConfig = util::get_spider_config();
            $config = $spiderConfig['click_house'];
        }

        $db = new Client($config);
        $db->database($config['dbname']);

        return $db;

        // $db = new ClickHouseDB\Client($config);
        // $db->database('default');
        // $db->setTimeout(1.5);      // 1 second , support only Int value
        // $db->setTimeout(10);       // 10 seconds
        // $db->setConnectTimeOut(5); // 5 seconds
        // $db->ping(true); // if can`t connect throw exception  
    }

    public static function insert($data, $config = null)
    {
        if (empty($data)) {
            return false;
        }

        // date_default_timezone_set('PRC');
        date_default_timezone_set('Asia/Shanghai');
        $data['source_pub_time'] = strtotime($data['source_pub_time']);

        $items = [];
        $values = [];

        $items[] = 'id';
        $value = [];
        $value[] = util::get_guid();
        $items[] = 'c_time';
        $value[] = strtotime(date('Y-m-d h:i:s', time()));
        $items[] = 'u_time';
        $value[] = strtotime(date('Y-m-d h:i:s', time()));

        foreach ($data as $k => $v) {
            $items[] = $k;
            $value[] = $v;
        }
        $values[] = $value;

        $db = self::connect($config);
        $table = $config['table'];
        $stat = $db->insert($table, $values, $items);

        // var_export($data, true)
        if ($stat->isError()) {
            log::error("写入clickhouse失败！url:{$data['source_url']}");
        }
    }
}
