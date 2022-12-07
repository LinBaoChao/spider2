<?php

declare(strict_types=1);

namespace app\controller;

use think\facade\Log;
use think\facade\Db;

use app\BaseController;
use app\model\WebsiteField;
use utils\Result;
use enum\ResultCode;

class WebsiteFieldController extends BaseController
{
    /**
     * @OA\Get(path="/websitefield/getList",
     *   tags={"网站管理"},
     *   summary="获取网站字段列表",
     *   @OA\Parameter(name="token", in="header", description="token", required=true, @OA\Schema(type="string")),
     *   @OA\Parameter(name="websiteId", in="query", description="网站Id", @OA\Schema(type="int")),
     *   @OA\Parameter(name="keyword", in="query", description="关键字", @OA\Schema(type="string")),
     *   @OA\Parameter(name="status", in="query", description="状态", @OA\Schema(type="int")),
     *   @OA\Response(response="200", description="WebsiteField")
     * )
     */
    public function getList(int $websiteId, string $keyword = '', int $status)
    {
        $retval = new Result();
        $retval->code = ResultCode::SUCCESS;
        $retval->message = '获取数据成功';

        try {
            $list = WebsiteField::where(function ($query) use ($websiteId, $keyword, $status) {
                $query->where('website_id', $websiteId);

                if (!empty($keyword)) {
                    $query->whereLike('name|selector', "%{$keyword}%");
                }

                if (!empty($status)) {
                    $query->where('status', $status);
                }
            })->select();

            $child = WebsiteField::where(function ($query) use ($websiteId, $keyword, $status) {
                $query->where('parent.website_id', $websiteId);

                if (!empty($keyword)) {
                    $query->whereLike('parent.name|parent.selector', "%{$keyword}%");
                }

                if (!empty($status)) {
                    $query->where('parent.status', $status);
                    $query->where('child.status', $status);
                }
            })
                ->alias('parent')
                ->field('child.*')
                ->Join('website_field child', 'child.parent_id=parent.id')
                ->select();

            if (!$child->isEmpty()) { // 如果没有子
                foreach ($list as $p) {
                    $cs = $child->where('parent_id', $p->id);
                    if (!$cs->isEmpty()) {
                        $p['children'] = $cs;
                    }
                }
            }

            $retval->result = $list;

            return json($retval);
        } catch (\Exception $ex) {
            $retval->code = ResultCode::ERROR;
            $retval->message = "获取数据失败：{$ex->getMessage()}";
            Log::error("{$retval->message}\r\nHead：" . json_encode($this->request->header()) . "\r\nParam：" . json_encode($this->request->param()));
            return json($retval);
        }
    }

    /**
     * @OA\Post(path="/websitefield/create",
     *   tags={"网站管理"},
     *   summary="创建网站字段",
     *   @OA\Parameter(name="token", in="header", description="token", required=true, @OA\Schema(type="string")),
     *   @OA\Parameter(name="params", in="query", description="json对象", required=true, @OA\Schema(type="object")),
     *   @OA\Response(response="200", description="WebsiteField")
     * )
     */
    public function create($params)
    {
        $retval = new Result();
        $retval->code = ResultCode::SUCCESS;
        $retval->message = '创建成功';

        try {
            // 验证参数，不通过会抛出异常
            $check = validate(WebsiteFieldValidate::class)->scene('create')->check($params);
            if (!$check) {
                $retval->code = ResultCode::FAIL;
                $retval->message = "参数验证不通过，请重新录入";
                return json($retval);
            }

            $websiteId = $params['websiteId'];
            $name = $params['name'];

            $o = WebsiteField::where('media_name', $websiteId)->where('name', $name)->findOrEmpty();
            if (!$o->isEmpty()) {
                $retval->code = ResultCode::FAIL;
                $retval->message = "已存在";
                return json($retval);
            }

            $o = WebsiteField::create([
                'parent_id' => $params['parentId'] ?? null,
                'website_id' => $websiteId,
                'name' => $name,
                'selector' => $params['selector'] ?? null,
                'selector_type' => $params['selectorType'] ?? null,
                'required' => $params['required'] ?? 0,
                'repeated' => $params['repeated'] ?? 0,
                'source_type' => $params['sourceType'] ?? 'url_context',
                'attached_url' => $params['attachedUrl'] ?? null,
                'is_write_db' => $params['isWriteDb'] ?? 1,
                'join_field' => $params['joinField'] ?? null,
                'filter' => $params['filter'] ?? null,
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
     * @OA\Put(path="/websitefield/update",
     *   tags={"网站管理"},
     *   summary="修改网站字段",
     *   @OA\Parameter(name="token", in="header", description="token", required=true, @OA\Schema(type="string")),
     *   @OA\Parameter(name="params", in="query", description="json对象", required=true, @OA\Schema(type="object")),
     *   @OA\Response(response="200", description="WebsiteField")
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
            $check = validate(WebsiteFieldValidate::class)->scene('update')->check($params);
            if (!$check) {
                $retval->code = ResultCode::FAIL;
                $retval->message = "参数验证不通过，请重新录入";
                return json($retval);
            }

            $id = $params['id'];

            $o = WebsiteField::update([
                'id' => $id,
                'selector' => $params['selector'] ?? null,
                'selector_type' => $params['selectorType'] ?? null,
                'required' => $params['required'] ?? 0,
                'repeated' => $params['repeated'] ?? 0,
                'source_type' => $params['sourceType'] ?? 'url_context',
                'attached_url' => $params['attachedUrl'] ?? null,
                'is_write_db' => $params['isWriteDb'] ?? 1,
                'join_field' => $params['joinField'] ?? null,
                'filter' => $params['filter'] ?? null,
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
     * * @OA\Put(path="/websitefield/delete",
     *   tags={"网站管理"},
     *   summary="删除网站字段",
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
            if (!WebsiteField::destroy($id)) {
                $retval->code = ResultCode::FAIL;
                $retval->message = '删除失败';
                return $retval;
            }

            return json($retval);
        } catch (\Exception $ex) {
            Db::rollback();

            $retval->code = ResultCode::ERROR;
            $retval->message = "删除失败：{$ex->getMessage()}";
            Log::error("{$retval->message}\r\nHead：" . json_encode($this->request->header()) . "\r\nParam：" . json_encode($this->request->param()));
            return json($retval);
        }
    }
}
