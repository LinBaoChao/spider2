<?php
// [ A PHP Framework For Crawler ]

namespace phpspider\core;

use phpspider\core\util;

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

        $params = ['mediaId'=> $mediaId,'status'=> $status];
        // if(!empty($mediaId)){
        //     $params[] = ['mediaId' => $mediaId];
        // }
        // if ($status != null) {
        //     $params[] = ['status' => $status];
        // }
        
        $url = $urlconfig . "website/getWebsiteConfig";

        try {
            $retval = json_decode(self::httpRequest($url, 'post', $params), true);
            return $retval;
        } catch (\Exception $ex) {
            $retval['code'] = 'error';
            $retval['message'] = "获取数据失败：{$ex->getMessage()}";
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
    public static function httpRequest($url, $method = 'get', $params = null, $timeout = 5)
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

        // POST方式发送请求
        if ('post' == strtolower($method)) {
            curl_setopt($curl, CURLOPT_POST, 1); //post提交方式
            curl_setopt($curl, CURLOPT_POSTFIELDS, $params); //设置传送的参数
        }

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HEADER, false); //设置header
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

        return $data;
    }
}
