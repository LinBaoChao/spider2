<?php
// [ A PHP Framework For Crawler ]

namespace topspider\core;

use topspider\core\util;
use topspider\core\log;

class website
{
    const URL = "http://127.0.0.1:7777/";

    /**
     * 获取所有网站配置信息
     * @param string $mediaId
     * @param int $status
     * @return mixed
     */
    public static function getWebsiteConfig(string $mediaId = '', int $status = -9999)
    {
        $spiderConfig = util::get_spider_config();
        $urlconfig = isset($spiderConfig['api_url']) ? $spiderConfig['api_url'] : self::URL;

        $retval = [
            'code' => 'success',
            'message' => '获取数据成功',
            'result' => null
        ];

        $data = ['mediaId' => $mediaId, 'status' => $status];
        // if(!empty($mediaId)){
        //     $data[] = ['mediaId' => $mediaId];
        // }
        // if ($status != null) {
        //     $data[] = ['status' => $status];
        // }

        $url = $urlconfig . "website/getWebsiteConfig";

        try {
            $retval = json_decode(self::httpRequest($url, 'post', $data), true);
            return $retval;
        } catch (\Exception $ex) {
            $retval['code'] = 'error';
            $retval['message'] = "获取数据失败：{$ex->getMessage()}";
            return $retval;
        }
    }

    /**
     * 创建采集资源
     * @param mixed $data
     * @return mixed
     */
    public static function articleCreate($data)
    {
        // $logstr = var_export($data, true);
        // log::add("create data:{$logstr}", 'api');

        $spiderConfig = util::get_spider_config();
        $urlconfig = isset($spiderConfig['api_url']) ? $spiderConfig['api_url'] : self::URL;
        $url = $urlconfig . "articleSpider/create";

        $retval = [
            'code' => 'success',
            'message' => '获取数据成功',
            'result' => null
        ];

        $data = array('params' => $data);

        try {
            $retval = json_decode(self::httpRequest($url, 'post', $data), true);
            return $retval;
        } catch (\Exception $ex) {
            $retval['code'] = 'error';
            $retval['message'] = "创建采集资源失败：{$ex->getMessage()}";
            log::add($retval['message'], 'api');
            return $retval;
        }
    }

    /**
     * 执行一个 HTTP 请求
     *
     * @param mixed $params 表单参数
     * @param int $timeout 超时时间
     * @param string $method 请求方法 post / get
     * @return array|string
     */
    public static function httpRequest($url, $method = 'get', $data = null, $timeout = 5, $header = null, $json = false)
    {
        $retval = [
            'code' => 'success',
            'message' => '获取数据成功',
            'result' => null
        ];

        $curl = curl_init();

        $is_https = stripos($url, 'https://') === 0 ? true : false;
        if ($is_https) {
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0); // 对认证证书来源的检查
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 1); // 从证书中检查SSL加密算法是否存在
        }

        // 设置header
        if (!empty($header)) {
            curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        } else {
            curl_setopt($curl, CURLOPT_HEADER, false);
        }

        if (!empty($data)) {
            // 是否json传输
            if ($json) {
                if(is_array($data)){
                    $data = json_encode($data);
                }
                $len = strlen($data);

                curl_setopt($curl, CURLOPT_HEADER, false);
                curl_setopt(
                    $curl,
                    CURLOPT_HTTPHEADER,
                    array(
                        'Content-Type: application/json; charset=utf-8',
                        'Content-Length:' . $len
                    )
                );
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data); //设置传送的参数
            }else{
                $data = http_build_query($data);

                // POST方式发送请求
                if ('post' == strtolower($method)) {
                    curl_setopt($curl, CURLOPT_POST, 1); //post提交方式
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data); //设置传送的参数
                } else {
                    $url = $url . '?' . $data;
                }
            }
        }

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); //要求结果为字符串且输出到屏幕上
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, $timeout); //设置等待时间

        $data = curl_exec($curl); //运行curl

        $err = curl_error($curl);
        if (false === $data || !empty($err)) { // 出错
            $errno = curl_errno($curl);
            $info = curl_getinfo($curl);
            $retval['code'] = 'error';
            $retval['message'] = "httpRequest出错：url：{$url}\r\n result: {$data}\r\n errorMessage: {$err}\r\n errno：{$errno}，errInfo：{$info}";

            curl_close($curl); //关闭curl

            return $retval;
        }

        curl_close($curl); //关闭curl
        // $data = json_decode($data, true);
        // $data = urldecode($data);

        // log::add("return data:{$data}", 'api');
        return $data;
    }
}
