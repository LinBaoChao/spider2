<?php

declare(strict_types=1);

namespace utils;

use think\helper\Str;

class Md5Hash
{

    const hashIterations = 3; // 加密多少次

    /**
     * 随机盐
     *
     * @param integer $len 长度 返回长度len
     * @return string
     */
    public static function saltRandom(int $len = 8): string
    {
        return Str::random($len);
    }


    /**
     * 密码二进制md5加密{hashIterations}次
     *
     * @param string $source 加密的数据
     * @param string $salt 盐
     * @param integer $hashIterations 加密次数 默认3
     * @return string
     */
    public static function simpleHash(string $source = '', string $salt = '', int $hashIterations = -1): string
    {
        if ($hashIterations == -1) {
            $hashIterations = self::hashIterations;
        }

        $iterations = $hashIterations < 1 ? 0 : $hashIterations - 1;
        $hashed = $salt . $source;
        for ($index = 0; $index < $iterations; $index++) {
            $hashed = md5($hashed, true); // 二进制加密
        }

        return md5($hashed);
    }

    public static function md5(string $str): string
    {
        return md5($str);
    }
}