<?php

declare(strict_types=1);

namespace app\controller;

use app\BaseController;
use app\model\ArticleSpider;
use utils\Result;
use enum\ResultCode;
use think\facade\Log;

class ArticleSpiderController extends BaseController
{
    /**
     * @OA\Get(path="/articleSpider/getListByPage",
     *   tags={"资源采集"},
     *   summary="获取采集资源列表",
     *   @OA\Parameter(name="token", in="header", description="token", required=true, @OA\Schema(type="string")),
     *   @OA\Parameter(name="keyword", in="query", description="关键词", @OA\Schema(type="string")),
     *   @OA\Parameter(name="page", in="query", description="第几页", @OA\Schema(type="int",default="1")),
     *   @OA\Parameter(name="pageSize", in="query", description="每页条数", @OA\Schema(type="int",default="20")),
     *   @OA\Response(response="200", description="Spider")
     * )
     */
    public function getListByPage(string $keyword = '', int $page = 1, int $pageSize = 20)
    {
        // 永不超时
        // ini_set('max_execution_time', 0);
        // set_time_limit(0);

        $retval = new Result();
        $retval->code = ResultCode::SUCCESS;
        $retval->message = '获取列表成功';

        try {
            $list = ArticleSpider::where(function ($query) use ($keyword) {
                if (!empty($keyword)) {
                    $query->whereLike('source_name|pub_source_name|pub_media_name|pub_product_name|pub_platform_name|pub_channel_name|source_title|source_author|source_content', "%{$keyword}%");
                }
            })
                ->orderRaw('source_pub_time desc')
                ->paginate(['page' => $page, 'pageSize' => $pageSize], false);

            $r = [
                'items' => $list->items(),
                'total' => $list->total()
            ];

            $retval->result = $r;

            return json($retval);
        } catch (\Exception $ex) {
            $retval->code = ResultCode::ERROR;
            $retval->message = "获取列表失败：{$ex->getMessage()}";
            Log::error("{$retval->message}\r\nHead：" . json_encode($this->request->header()) . "\r\nParam：" . json_encode($this->request->param()));
            return json($retval);
        }
    }

    /**
     * @OA\Post(path="/articleSpider/create",
     *   tags={"资源采集"},
     *   summary="创建采集资源",
     *   @OA\Parameter(name="token", in="header", description="token", required=true, @OA\Schema(type="string")),
     *   @OA\Parameter(name="params", in="query", description="json对象", required=true, @OA\Schema(type="object")),
     *   @OA\Response(response="200", description="true")
     * )
     */
    public function create($params)
    {
        // $logstr = var_export($params, true);
        // Log::debug("create data:{$logstr}\r\nParams：" . json_encode($this->request->param()));
        // Log::debug("create data2:{$params}\r\nParams：" . json_encode($params));

        $retval = new Result();
        $retval->code = ResultCode::SUCCESS;
        $retval->message = '创建成功';

        try {
            $o = ArticleSpider::create($params);

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
     * @OA\Delete(path="/articleSpider/delete",
     *   tags={"资源采集"},
     *   summary="删除",
     *   @OA\Parameter(name="token", in="header", description="token", required=true, @OA\Schema(type="string")),
     *   @OA\Parameter(name="id", in="query", description="id", required=true, @OA\Schema(type="int")),
     *   @OA\Response(response="200", description="true")
     * )
     */
    public function delete(int $id)
    {
        $retval = new Result();
        $retval->code = ResultCode::SUCCESS;
        $retval->message = '删除成功';

        try {
            if (!ArticleSpider::destroy($id)) {
                $retval->code = ResultCode::FAIL;
                $retval->message = '删除失败';
                return $retval;
            }

            return json($retval);
        } catch (\Exception $ex) {
            $retval->code = ResultCode::ERROR;
            $retval->message = "删除失败：{$ex->getMessage()}";
            Log::error("{$retval->message}\r\nHead：" . json_encode($this->request->header()) . "\r\nParam：" . json_encode($this->request->param()));
            return json($retval);
        }
    }
}
