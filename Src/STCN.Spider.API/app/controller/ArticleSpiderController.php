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
        $retval = new Result();
        $retval->code = ResultCode::SUCCESS;
        $retval->message = '获取列表成功';

        try {
            $list = ArticleSpider::where(function ($query) use ($keyword) {
                if (!empty($keyword)) {
                    $query->whereLike('source_name|pub_source_name|pub_media_name|pub_product_name|pub_platform_name|pub_channel_name|source_title|source_author|source_pub_time|source_content', "%{$keyword}%");
                }
            })
                ->orderRaw('source_pub_time desc')
                ->paginate(['page' => $page, 'pageSize' => $pageSize], false);

            $r = [
                'items' => $list->items(),
                'total' => count($list->items())
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
