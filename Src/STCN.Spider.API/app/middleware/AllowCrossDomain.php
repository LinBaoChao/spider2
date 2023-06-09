<?php

declare(strict_types=1);

namespace app\middleware;

use Closure;
use think\Config;
use think\Request;
use think\Response;

class AllowCrossDomain
{
    protected $crossHeader;

    protected $header = [
        'Access-Control-Allow-Origin' => '*',
        'Access-Control-Allow-Credentials' => 'true',
        'Access-Control-Max-Age'           => 1800,
        'Access-Control-Allow-Methods'     => 'GET, POST, PATCH, PUT, DELETE, OPTIONS, HEAD, FILE',
        'Access-Control-Allow-Headers'     => 'Token, Authorization, Content-Type, If-Match, If-Modified-Since, If-None-Match, If-Unmodified-Since, X-CSRF-TOKEN, X-Requested-With, Accept, Cache-Control, DNT, Keep-Alive, Origin,User-Agent, X-Mx-ReqToken, Content-Length, Accept-Encoding, Accept-Language, ignoreCancelToken, Referer, Agent',
    ];

    public function __construct(Config $config)
    {
        $this->crossHeader = [
            'Access-Control-Allow-Origin' => $config->get('cross.allow_origin'),
            'Access-Control-Allow-Credentials' => $config->get('cross.allow_credentials'),
            'Access-Control-Max-Age'           => $config->get('cross.max_age'),
            'Access-Control-Allow-Methods'     => $config->get('cross.allow_methods'),
            'Access-Control-Allow-Headers'     => $config->get('cross.allow_headers'),
        ];
    }

    /**
     * 允许跨域请求
     * @access public
     * @param Request $request
     * @param Closure $next
     * @return Response
     */
    public function handle($request, Closure $next)
    {
        $header = array_merge($this->header, $this->crossHeader);
        return $next($request)->header($header);
    }
}