<?php

declare(strict_types=1);

namespace app\middleware;

use app\service\TokenService;
use utils\Result;
use think\facade\Log;
use think\Response;
use enum\ResultCode;
use think\facade\Config;

class CheckToken
{
    /**
     * 处理请求
     *
     * @param \think\Request $request
     * @param \Closure       $next
     * @return Response
     */
    public function handle($request, \Closure $next)
    {
        Log::debug(json_encode($request->header()));

        $noTokenList = Config::get('token.no_token_list'); // 不需要检查token的方法
        $pattern = Config::get('token.pattern'); // 特殊放行

        $controller = $request->controller(true);
        $action = $request->action(true);

        // Log::debug("pathinfo:" . $request->pathinfo());
        // Log::debug("conaction:" . $controller . '/' . $action);

        // 如果不需要判断token则直接返回
        if (in_array($controller . '/' . $action, $noTokenList)) {
            return $next($request);
        } else {
            foreach ($pattern as $ptn) // 特殊放行
            {
                if (preg_match("/{$ptn}/i", $request->pathinfo())) {
                    return $next($request);
                }
            }
        }

        $tokenName = Config::get('token.header_token_key', 'Token');

        $token = $request->header($tokenName); // 大写
        if (empty($token)) {
            $token = $request->header('Authorization');
            Log::debug("Authorization:" . $token);
            if (empty($token)) {
                $token = $request->param(strtolower($tokenName)); // 小写
            }
        }

        $retval = new Result();
        $retval->code = ResultCode::SUCCESS;
        $retval->message = '成功';

        Log::debug('$token:' . $token);
        // 没有token
        if (!$token) {
            Log::debug($controller . '/' . $action . ' null token');
            $retval->code = ResultCode::ERROR;
            $retval->message = "token不能为空!";
            return response($retval, 200, [], 'json'); // 此处的状态得是200否则有些前端会出现Network error的错误
            // return response("token不能为空！");
        }

        $retval = TokenService::checkToken($token);
        Log::debug('checktoken:' . json_encode($retval->result));
        if ($retval->code !== ResultCode::SUCCESS) {
            $retval->code = ResultCode::TIMEOUT;
            $retval->message = 'token不正确或已过期：' . $retval->message;
            return response($retval, 401, [], 'json');
            //return response('token不正确：' . $retval->message);
        }

        return $next($request);
    }
}
