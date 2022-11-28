<?php

declare(strict_types=1);

namespace app\service;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use think\facade\Config;
use utils\Result;
use enum\ResultCode;
use think\facade\Log;

class TokenService
{
    private static function getKey()
    {
        return Config::get('token.key');
    }
    public static function getToken($data = null): Result
    {
        $retval = new Result();
        $retval->code = ResultCode::SUCCESS;
        $retval->message = '成功';

        $time = time();
        $token = array(
            'typ' => Config::get('token.type'),
            'iss' => isset($data['id']) ? $data['id'] : '', // 签发者 可以为空
            'aud' => Config::get('token.aud'), // 接收者 可为空
            'iat' => $time, //签发时间
            'nbf' => $time, //开始生效时间
            'exp' => $time + Config::get('token.expires_in'), // token过期时间
            'data' => $data, // 存储的用户信息
        );

        try {
            $retval->result = JWT::encode($token, self::getKey(), Config::get('token.alg'));
        } catch (\Exception $e) {
            $retval->result = null;
            $retval->code = ResultCode::ERROR;
            $retval->message = $e->getMessage();
        }

        return $retval;
    }
    public static function checkToken($token)
    {
        $retval = new Result();
        $retval->code = ResultCode::SUCCESS;
        $retval->message = '成功';

        try {
            $retval->result = JWT::decode($token, new Key(self::getKey(), Config::get('token.alg')));
        } catch (\Exception $e) {
            $retval->code = ResultCode::ERROR;
            $retval->message = $e->getMessage();
            $retval->result = null;
        }

        return $retval;
    }

    public static function getDecodeToken($request)
    {
        $retval = new Result();
        $retval->code = ResultCode::SUCCESS;
        $retval->message = '成功';

        try {
            $tokenName = Config::get('token.header_token_key', 'Token');

            $token = $request->header($tokenName); // 大写
            if (empty($token)) {
                $token = $request->header('Authorization');
                Log::debug("getDecodeToken Authorization:" . $token);
                if (empty($token)) {
                    $token = $request->param(strtolower($tokenName)); // 小写
                }
            }

            if (empty($token)) {
                $retval->code = ResultCode::FAIL;
                $retval->message = '没有找到token';
                $retval->result = null;
            } else {
                $retval->result = JWT::decode($token, new Key(self::getKey(), Config::get('token.alg')));
            }
        } catch (\Exception $e) {
            $retval->code = ResultCode::ERROR;
            $retval->message = $e->getMessage();
            $retval->result = null;
        }

        return $retval;
    }

    public static function getCurrentUser($request)
    {
        $retval = new Result();
        $retval->code = ResultCode::SUCCESS;
        $retval->message = '获取当前用户成功';

        try {
            $token = (object)TokenService::getDecodeToken($request);
            if ($token->code !== ResultCode::SUCCESS) {
                $token->code = ResultCode::TIMEOUT;
                $retval->message = "获取当前用户失败，请重新登录！";
                return $retval;
            }

            $retval->result = $token->result->data;

            return $retval;
        } catch (\Exception $ex) {
            $retval->code = ResultCode::ERROR;
            $retval->message = "获取当前用户失败：{$ex->getMessage()}";
            Log::error("{$retval->message}\r\nHead：" . json_encode($request->header()) . "\r\nParam：" . json_encode($request->param()));
            return $retval;
        }
    }

    /**
     * 解析token字符串, 判断失效时间，返回是否生成新的token
     *
     * @param string $token
     * @return boolean
     */
    public static function isCreatedNewToken(string $token): bool
    {
        $decoded = self::checkToken($token)->result;
        if ($decoded !== null) {
            $exp = $decoded['exp'];
            $time = time();
            if ($exp - $time <= Config::get('token.rest_expires_in')) {
                return true;
            }
        }
        return false;
    }
}