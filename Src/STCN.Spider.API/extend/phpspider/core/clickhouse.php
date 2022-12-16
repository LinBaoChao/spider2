<?php

namespace phpspider\core;

require_once __DIR__ . '../../../phpclickhouse/include.php';
//require_once __DIR__ . '/../vendor/autoload.php';

use ClickHouseDB\Client;
use phpspider\core\log;

class clickhouse
{
    // clickHouse db config
    private static $dbconfig = array(
        'host' => '10.254.15.57',
        'port' => '8123',
        'username' => 'linbaocao',
        'password' => '345556',
        'dbname' => 'sentiment_db',
        'table' => 'sentiment_tmp', // 生产表为sentiment_t
    );

    public static function connect($config = null)
    {
        if (empty($config)) {
            $spiderConfig = require_once __DIR__ . '../../../../config/spider.php';
            $config = isset($spiderConfig['click_house']) ? $spiderConfig['click_house'] : self::$dbconfig;
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
        $msg = var_export($data, true);
        log::add('data:' . $msg, 'debug');
        log::add('config:' . var_export($config, true), 'info');

        $db = self::connect($config);
        $table = $config['table'];

        $items = [];
        $values = [];

        $items[] = 'id';
        $value = [];
        $value[] = self::getGuid();
        foreach ($data as $k => $v) {
            $items[] = $k;
            $value[] = $v;
        }
        $values[] = $value;

        log::add('fields:' . var_export($items, true), 'data');
        log::add('values:' . var_export($values, true), 'data');

        //$stat = $db->insert($table, $values, $items);
    }

    public static function getGuid()
    {
        if (function_exists('com_create_guid') === true) {
            return trim(com_create_guid(), '{}');
        }

        return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
    }
}
