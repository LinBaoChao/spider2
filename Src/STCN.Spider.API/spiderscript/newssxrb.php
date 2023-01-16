<?php
require_once __DIR__ . '/../extend/topspider/autoloader.php';
use topspider\core\topspider;
use topspider\core\selector;
use topspider\core\website;
use topspider\core\log;
use topspider\core\util;
function on_extract_field_newssxrb($fieldname, $data, $page)
{
    if ($fieldname == 'source_pub_time') {
        log::add("on_extract_field_newssxrb." . $fieldname . ":" . $data, "script");

        $data = str_replace("年", "-", $data);
        $data = str_replace("月", "-", $data);
        $data = str_replace("日", " ", $data);
        log::add("on_extract_field_newssxrb." . $fieldname . " change:" . $data, "script");
        if (date('Y-m-d H:i', strtotime($data)) == $data) {
            return $data;
        } else {
            return false;
        }
    }

    return $data;
}