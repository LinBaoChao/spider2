<?php

declare(strict_types=1);

namespace app\controller;

use think\facade\Log;
use think\facade\Db;

use app\BaseController;
use app\model\Website;
use app\model\WebsiteField;
use app\service\WebsiteService;
use app\validate\WebsiteValidate;
use utils\Result;
use enum\ResultCode;

class WebsiteController extends BaseController
{
    /**
     * @OA\Get(path="/website/getListByPage",
     *   tags={"网站管理"},
     *   summary="获取网站分页列表",
     *   @OA\Parameter(name="token", in="header", description="token", required=true, @OA\Schema(type="string")),
     *   @OA\Parameter(name="keyword", in="query", description="关键字", @OA\Schema(type="string")),
     *   @OA\Parameter(name="status", in="query", description="状态", @OA\Schema(type="int")),
     *   @OA\Parameter(name="page", in="query", description="第几页", @OA\Schema(type="int",default="1")),
     *   @OA\Parameter(name="pageSize", in="query", description="每页条数", @OA\Schema(type="int",default="20")),
     *   @OA\Response(response="200", description="Website")
     * )
     */
    public function getListByPage(string $keyword = null, int $status = null, int $page = 1, int $pageSize = 20)
    {
        $retval = new Result();
        $retval->code = ResultCode::SUCCESS;
        $retval->message = '获取数据成功';

        try {
            $list = Website::where(function ($query) use ($keyword, $status) {
                if (!empty($keyword)) {
                    $query->whereLike('media_name|product_name|platform|channel|name|domains|scan_urls|list_urls|content_urls', "%{$keyword}%");
                }

                if ($status !== null) {
                    $query->where('status', $status);
                }
            })
                ->field('*')
                ->orderRaw('create_time desc')
                ->paginate(['page' => $page, 'pageSize' => $pageSize], false);


            $r = [
                'items' => $list->items(),
                'total' => $list->total()
            ];
            $retval->result = $r;

            return json($retval);
        } catch (\Exception $ex) {
            $retval->code = ResultCode::ERROR;
            $retval->message = "获取数据失败：{$ex->getMessage()}";
            Log::error("{$retval->message}\r\nHead：" . json_encode($this->request->header()) . "\r\nParam：" . json_encode($this->request->param()));
            return json($retval);
        }
    }

    /**
     * @OA\Post(path="/website/create",
     *   tags={"网站管理"},
     *   summary="创建网站",
     *   @OA\Parameter(name="token", in="header", description="token", required=true, @OA\Schema(type="string")),
     *   @OA\Parameter(name="params", in="query", description="json对象", required=true, @OA\Schema(type="object")),
     *   @OA\Response(response="200", description="true")
     * )
     */
    public function create($params)
    {
        $retval = new Result();
        $retval->code = ResultCode::SUCCESS;
        $retval->message = '创建成功';

        try {
            // 验证参数，不通过会抛出异常
            $check = validate(WebsiteValidate::class)->scene('create')->check($params);
            if (!$check) {
                $retval->code = ResultCode::FAIL;
                $retval->message = "参数验证不通过，请重新录入";
                return json($retval);
            }

            $mediaName = $params['mediaName'] ?? null;
            $name = $params['name'] ?? '';

            $o = Website::where('media_name', $mediaName)->whereOr('name', $name)->findOrEmpty();
            if (!$o->isEmpty()) {
                $retval->code = ResultCode::FAIL;
                $retval->message = "媒体已存在";
                return json($retval);
            }

            $o = Website::create([
                'parent_id' => $params['parentId'] ?? null,
                'media_name' => $mediaName,
                'name' => $name,
                'product_name' => $params['productName'] ?? null,
                'platform' => $params['platform'] ?? null,
                'channel' => $params['channel'] ?? null,
                'domains' => $params['domains'] ?? null,
                'scan_urls' => $params['scanUrls'] ?? null,
                'list_urls' => $params['listUrls'] ?? null,
                'content_urls' => $params['contentUrls'] ?? null,
                'input_encoding' => $params['inputEncoding'] ?? null,
                'output_encoding' => $params['outputEncoding'] ?? null,
                'tasknum' => $params['tasknum'] ?? null,
                'multiserver' => $params['multiserver'] ?? null,
                'serverid' => $params['serverid'] ?? null,
                'save_running_state' => $params['saveRunningState'] ?? null,
                'interval' => $params['interval'] ?? null,
                'timeout' => $params['timeout'] ?? null,
                'max_try' => $params['maxTry'] ?? null,
                'max_depth' => $params['maxDepth'] ?? null,
                'max_fields' => $params['maxFields'] ?? null,
                'user_agent' => $params['userAgent'] ?? null,
                'client_ip' => $params['clientIp'] ?? null,
                'proxy' => $params['proxy'] ?? null,
                'status' => $params['status'] ?? 1,
            ]);

            $retval->result = $o;

            return json($retval);
        } catch (\Exception $ex) {
            $retval->code = ResultCode::ERROR;
            $retval->message = "创建失败：{$ex->getMessage()}";
            Log::error("{$retval->message}\r\nHead：" . json_encode($this->request->header()) . "\r\nParam：" . json_encode($this->request->param()));
            return json($retval);
        }
    }

    /**
     * @OA\Put(path="/website/update",
     *   tags={"网站管理"},
     *   summary="修改网站",
     *   @OA\Parameter(name="token", in="header", description="token", required=true, @OA\Schema(type="string")),
     *   @OA\Parameter(name="params", in="query", description="json对象", required=true, @OA\Schema(type="object")),
     *   @OA\Response(response="200", description="true")
     * )
     */
    public function update($params)
    {
        Log::debug($params);
        $retval = new Result();
        $retval->code = ResultCode::SUCCESS;
        $retval->message = '修改成功';

        try {
            // 验证参数，不通过会抛出异常
            $check = validate(WebsiteValidate::class)->scene('update')->check($params);
            if (!$check) {
                $retval->code = ResultCode::FAIL;
                $retval->message = "参数验证不通过，请重新录入";
                return json($retval);
            }

            $id = $params['id'];
            $mediaName = $params['mediaName'] ?? null;
            $name = $params['name'] ?? '';

            $o = Website::where('id', $id)->findOrEmpty();
            if ($o->mediaName != $mediaName) {
                $w = Website::where('media_name', $mediaName)->findOrEmpty();
                if (!$w->isEmpty()) {
                    $retval->code = ResultCode::FAIL;
                    $retval->message = "媒体名称已存在";
                    return json($retval);
                }
            }
            if ($o->name != $name) {
                $w = Website::where('name', $name)->findOrEmpty();
                if (!$w->isEmpty()) {
                    $retval->code = ResultCode::FAIL;
                    $retval->message = "媒体名称已存在";
                    return json($retval);
                }
            }

            $o = Website::update([
                'id' => $id,
                'media_name' => $mediaName,
                'name' => $name,
                'product_name' => $params['productName'] ?? null,
                'platform' => $params['platform'] ?? null,
                'channel' => $params['channel'] ?? null,
                'domains' => $params['domains'] ?? null,
                'scan_urls' => $params['scanUrls'] ?? null,
                'list_urls' => $params['listUrls'] ?? null,
                'content_urls' => $params['contentUrls'] ?? null,
                'input_encoding' => $params['inputEncoding'] ?? null,
                'output_encoding' => $params['outputEncoding'] ?? null,
                'tasknum' => $params['tasknum'] ?? null,
                'multiserver' => $params['multiserver'] ?? null,
                'serverid' => $params['serverid'] ?? null,
                'save_running_state' => $params['saveRunningState'] ?? null,
                'interval' => $params['interval'] ?? null,
                'timeout' => $params['timeout'] ?? null,
                'max_try' => $params['maxTry'] ?? null,
                'max_depth' => $params['maxDepth'] ?? null,
                'max_fields' => $params['maxFields'] ?? null,
                'user_agent' => $params['userAgent'] ?? null,
                'client_ip' => $params['clientIp'] ?? null,
                'proxy' => $params['proxy'] ?? null,
                'status' => $params['status'] ?? 1,
            ]);

            $retval->result = $o;

            return json($retval);
        } catch (\Exception $ex) {
            $retval->code = ResultCode::ERROR;
            $retval->message = "修改失败：{$ex->getMessage()}";
            Log::error("{$retval->message}\r\nHead：" . json_encode($this->request->header()) . "\r\nParam：" . json_encode($this->request->param()));
            return json($retval);
        }
    }

    /**
     * * @OA\Put(path="/website/delete",
     *   tags={"网站管理"},
     *   summary="删除网站",
     *   @OA\Parameter(name="token", in="header", description="token", required=true, @OA\Schema(type="string")),
     *   @OA\Parameter(name="id", in="query", description="id", required=true, @OA\Schema(type="any")),
     *   @OA\Response(response="200", description="true")
     * )
     */
    public function delete($id)
    {
        $retval = new Result();
        $retval->code = ResultCode::SUCCESS;
        $retval->message = '删除成功';

        try {
            Db::startTrans();

            WebsiteField::where('website_id', $id)->delete(); // 删除子
            if (!Website::destroy($id)) {
                $retval->code = ResultCode::FAIL;
                $retval->message = '删除失败';
                return $retval;
            }

            Db::commit();

            return json($retval);
        } catch (\Exception $ex) {
            Db::rollback();

            $retval->code = ResultCode::ERROR;
            $retval->message = "删除失败：{$ex->getMessage()}";
            Log::error("{$retval->message}\r\nHead：" . json_encode($this->request->header()) . "\r\nParam：" . json_encode($this->request->param()));
            return json($retval);
        }
    }

    /**
     * @OA\Get(path="/website/getWebsiteConfig",
     *   tags={"网站管理"},
     *   summary="获取网站所有配置信息",
     *   @OA\Parameter(name="token", in="header", description="token", required=true, @OA\Schema(type="string")),
     *   @OA\Response(response="200", description="Website")
     * )
     */
    public function getWebsiteConfig()
    {
        return json(WebsiteService::getWebsiteConfig());
    }
}
