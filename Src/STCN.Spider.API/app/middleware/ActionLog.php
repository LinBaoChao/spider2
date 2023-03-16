<?php

declare(strict_types=1);

namespace app\middleware;

use think\facade\Log;
use think\facade\Config;
use think\Response;
use app\service\TokenService;
use enum\ResultCode;

class ActionLog
{
    protected $logChannel = 'ActionLog';

    /**
     * 处理请求
     *
     * @param \think\Request $request
     * @param \Closure       $next
     * @return Response
     */
    public function handle($request, \Closure $next)
    {
        $method = strtolower($request->method());
        $is_ajax = $request->isAjax();
        $route = $request->pathinfo();
        $req = $_REQUEST;
        unset($req['s'], $req['_session']);
        $req_data = $req ? json_encode($req) : '';
        $param = $request->param();
        $heads = $request->header();

        $currentUser = ['userId' => '', 'userCode' => '', 'username' => '', 'realName' => '']; // 当前用户
        $token = TokenService::getCurrentUser($request);
        if ($token->code == ResultCode::SUCCESS && !empty($token->result)) {
            $currentUser['userId'] = $token->result->id;
            $currentUser['userCode'] = $token->result->userCode;
            $currentUser['username'] = $token->result->username;
            $currentUser['realName'] = $token->result->realName;
        }

        $data = [
            'currentUser' => $currentUser,
            'route' => $route, //操作的路由地址
            'controller' => $request->controller(),
            'action' => $request->action(),
            'method' => $method, //get/post
            'requestType' => $is_ajax ? 'ajax' : 'normal',
            'requestData' => $req_data, //get/post的数据
            'param' => $param,
            'heads' => $heads,
            'tokenDecode' => $token,
            'ip' => $_SERVER["REMOTE_ADDR"],
            'createTime' => date("Y-m-d H:i:s", time()),
        ];
        Log::channel($this->logChannel)->info($data);

        return $next($request);
    }
}
