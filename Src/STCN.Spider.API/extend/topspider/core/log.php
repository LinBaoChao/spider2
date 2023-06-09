<?php
//----------------------------------
// 日志类文件
//----------------------------------

namespace topspider\core;
// 引入PATH_LOG
require_once __DIR__ . '/constants.php';

class log
{
    public static $log_show = false;
    public static $log_type = false;
    public static $log_file = PATH_LOG . "/topspider.log";
    public static $file_path = PATH_LOG . "/spider/";
    public static $out_sta = "";
    public static $out_end = "";

    public static function note($msg)
    {
        self::$out_sta = self::$out_end = "";
        self::msg($msg, 'note');
    }

    public static function info($msg)
    {
        self::$out_sta = self::$out_end = "";
        self::msg($msg, 'info');
    }

    public static function warn($msg)
    {
        self::$out_sta = self::$out_end = "";
        if (!util::is_win()) 
        {
            self::$out_sta = "\033[33m";
            self::$out_end = "\033[0m";
        }

        self::msg($msg, 'warn');
    }

    public static function debug($msg)
    {
        self::$out_sta = self::$out_end = "";
        if (!util::is_win()) 
        {
            self::$out_sta = "\033[36m";
            self::$out_end = "\033[0m";
        }

        self::msg($msg, 'debug');
    }

    public static function error($msg)
    {
        self::$out_sta = self::$out_end = "";
        if (!util::is_win()) 
        {
            self::$out_sta = "\033[31m";
            self::$out_end = "\033[0m";
        }

        self::msg($msg, 'error');
    }

    public static function msg($msg, $log_type)
    {
        if ($log_type != 'note' && self::$log_type && strpos(self::$log_type, $log_type) === false) 
        {
            return false;
        }

        if ($log_type == 'note') 
        {
            $msg = self::$out_sta. $msg . "\n".self::$out_end;
        }
        else 
        {
            $msg = self::$out_sta.date("Y-m-d H:i:s")." [{$log_type}] " . $msg .self::$out_end. "\n";
        }
        if(self::$log_show)
        {
            echo $msg;
        }

        $path = self::$file_path . date('Ymd') . '/';
        util::path_exists($path);
        file_put_contents($path . strtolower($log_type) . ".log", $msg, FILE_APPEND | LOCK_EX);
        //file_put_contents(self::$log_file, $msg, FILE_APPEND | LOCK_EX); // lbc todo add to db and trace
    }

    /**
     * 记录日志 XXX
     * @param string $msg
     * @param string $log_type  Note|Warning|Error
     * @return void
     */
    public static function add($msg, $log_type = 'Debug')
    {
        if (self::$log_type && strpos(self::$log_type, $log_type) === false) {
            return false;
        }

        $msg = date("Y-m-d H:i:s") . " [{$log_type}] " . $msg . "\n";
        
        if(self::$log_show)
        {
            echo $msg;
        }

        $path = self::$file_path . date('Ymd') . '/';
        util::path_exists($path);

        $name = $path . $log_type . ".log";
        // if(is_file($name)){ // 如果文件存在
        //     if (filesize($name) > 10 * 1024 * 1024) { // 大于10m则新建
                
        //     }
        // }        
        file_put_contents($name, $msg, FILE_APPEND | LOCK_EX);
    }

}
