<?php

declare(strict_types=1);

namespace app\controller;

use think\facade\Log;
use think\facade\Db;

use app\BaseController;
use app\model\WebsiteField;
use app\validate\WebsiteFieldValidate;
use utils\Result;
use enum\ResultCode;

class WebsiteFieldController extends BaseController
{
    /**
     * @OA\Get(path="/websiteField/getList",
     *   tags={"网站管理"},
     *   summary="获取网站字段列表",
     *   @OA\Parameter(name="token", in="header", description="token", required=true, @OA\Schema(type="string")),
     *   @OA\Parameter(name="websiteId", in="query", description="网站Id", required=true, @OA\Schema(type="int")),
     *   @OA\Parameter(name="keyword", in="query", description="关键字", @OA\Schema(type="string")),
     *   @OA\Parameter(name="status", in="query", description="状态", @OA\Schema(type="int")),
     *   @OA\Response(response="200", description="WebsiteField")
     * )
     */
    public function getList(int $websiteId, string $keyword  = null, int $status = null)
    {
        $retval = new Result();
        $retval->code = ResultCode::SUCCESS;
        $retval->message = '获取数据成功';

        try {
            $list = WebsiteField::where(function ($query) use ($websiteId, $keyword, $status) {
                $query->where('website_id', $websiteId)->whereNull('parent_id');

                if (!empty($keyword)) {
                    $query->whereLike('field_name|selector', "%{$keyword}%");
                }

                if ($status !== null) {
                    $query->where('status', $status);
                }
            })->select();

            $child = WebsiteField::where(function ($query) use ($websiteId, $keyword, $status) {
                $query->where('child.website_id', $websiteId)->whereNotNull('child.parent_id');

                if (!empty($keyword)) {
                    $query->whereLike('parent.field_name|parent.selector', "%{$keyword}%");
                }

                if (!empty($status)) {
                    $query->where('child.status', $status);
                    // $query->where('child.status', $status);
                }
            })
                ->alias('child')
                ->field('child.*')
                //->Join('website_field child', 'child.parent_id=parent.id')
                ->select();

            if (!$child->isEmpty()) {
                foreach ($list as $p) {
                    $cs = $child->where('parent_id', $p->id);
                    if (!$cs->isEmpty()) {
                        $p['children'] = $cs;
                    } else {
                        $p['children'] = null;
                    }
                    unset($cs);
                }
            }

            $retval->result = $list;

            unset($list);
            unset($child);

            return json($retval);
        } catch (\Exception $ex) {
            $retval->code = ResultCode::ERROR;
            $retval->message = "获取数据失败：{$ex->getMessage()}";
            Log::error("{$retval->message}\r\nHead：" . json_encode($this->request->header()) . "\r\nParam：" . json_encode($this->request->param()));
            return json($retval);
        }
    }

    /**
     * @OA\Post(path="/websiteField/create",
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
            $fieldName = $params['fieldName'];
            $parentId = $params['parentId'] ?? null;

            $o = WebsiteField::where('website_id', $websiteId)->where('field_name', $fieldName)->where('parent_id', $parentId)->findOrEmpty();
            if (!$o->isEmpty()) {
                $retval->code = ResultCode::FAIL;
                $retval->message = "已存在";
                return json($retval);
            }

            $o = WebsiteField::create([
                'parent_id' => $parentId,
                'website_id' => $websiteId,
                'field_name' => $fieldName,
                'selector' => $params['selector'] ?? null,
                'selector_type' => $params['selectorType'] ?? null,
                'required' => $params['required'] ?? 0,
                'repeated' => $params['repeated'] ?? 0,
                'source_type' => $params['sourceType'] ?? null,
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
     * @OA\Put(path="/websiteField/update",
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
            $fieldName = $params['fieldName'];

            $o = WebsiteField::where('id', $id)->findOrEmpty();
            if ($o->fieldName != $fieldName) {
                $o = WebsiteField::where('website_id', $o->websiteId)->where('fieldName', $fieldName)->where('parent_id', $o->parentId)->findOrEmpty();
                if (!$o->isEmpty()) {
                    $retval->code = ResultCode::FAIL;
                    $retval->message = "已存在";
                    return json($retval);
                }
            }

            $o = WebsiteField::update([
                'id' => $id,
                'field_name' => $fieldName,
                'parent_id' => $params['parentId'] ?? null,
                'selector' => $params['selector'] ?? null,
                'selector_type' => $params['selectorType'] ?? null,
                'required' => $params['required'] ?? 0,
                'repeated' => $params['repeated'] ?? 0,
                'source_type' => $params['sourceType'] ?? null,
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
     * * @OA\Put(path="/websiteField/delete",
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