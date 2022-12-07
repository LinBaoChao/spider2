<?php

declare(strict_types=1);

namespace app\controller;

use app\BaseController;
use app\model\Dept;
use app\model\UserDept;
use utils\Result;
use enum\ResultCode;
use app\service\TokenService;
use think\facade\Log;
use app\validate\DeptValidate;

class DeptController extends BaseController
{
    private $ids = array();

    /**
     * @OA\Get(path="/dept/getCurrentUserDept",
     *   tags={"部门管理"},
     *   summary="获取当前用户部门",
     *   @OA\Parameter(name="token", in="header", description="token", required=true, @OA\Schema(type="string")),
     *   @OA\Response(response="200", description="Department List")
     * )
     */
    public function getCurrentUserDept()
    {
        $retval = new Result();
        $retval->code = ResultCode::SUCCESS;
        $retval->message = '成功';
        $retval->result = [];

        try {
            $token = (object)TokenService::getCurrentUser($this->request);
            if ($token->code !== ResultCode::SUCCESS) {
                $retval->result = [];
                $retval->message = "当前用户不存在，请重新登录！";
                return $retval;
            }

            $user = $token->result;

            $retval->result = $this->getUserDept($user->id);
            return json($retval);
        } catch (\Exception $ex) {
            $retval->code = ResultCode::ERROR;
            $retval->message = "获取当前用户部门失败：{$ex->getMessage()}";
            Log::error("{$retval->message}\r\nHead：" . json_encode($this->request->header()) . "\r\nParam：" . json_encode($this->request->param()));
            return json($retval);
        }
    }

    /**
     * @OA\Get(path="/dept/getUserDept",
     *   tags={"部门管理"},
     *   summary="获取用户部门",
     *   @OA\Parameter(name="token", in="header", description="token", required=true, @OA\Schema(type="string")),
     *   @OA\Parameter(name="userId", in="query", description="用户id", @OA\Schema(type="int")),
     *   @OA\Response(response="200", description="Department List")
     * )
     */
    public function getUserDept($userId)
    {
        $retval = new Result();
        $retval->code = ResultCode::SUCCESS;
        $retval->message = '成功';
        $retval->result = [];

        try {
            $list = Dept::where('ud.user_id', $userId)
                ->alias('d')
                ->field('d.*')
                ->leftJoin('user_dept ud', 'ud.dept_id=d.id')
                ->orderRaw('if(isnull(d.order_no),1,0),d.order_no')
                ->select();

            $retval->result = $list;
            return json($retval);
        } catch (\Exception $ex) {
            $retval->code = ResultCode::ERROR;
            $retval->message = "获获取用户部门失败：{$ex->getMessage()}";
            Log::error("{$retval->message}\r\nHead：" . json_encode($this->request->header()) . "\r\nParam：" . json_encode($this->request->param()));
            return json($retval);
        }
    }

    /**
     * @OA\Get(path="/dept/getList",
     *   tags={"部门管理"},
     *   summary="获取部门列表",
     *   @OA\Parameter(name="token", in="header", description="token", required=true, @OA\Schema(type="string")),
     *   @OA\Parameter(name="deptName", in="query", description="部门名称", @OA\Schema(type="string")),
     *   @OA\Parameter(name="status", in="query", description="状态", @OA\Schema(type="int")),
     *   @OA\Response(response="200", description="Department List")
     * )
     */
    public function getList(string $deptName = '', int $status = null)
    {
        $retval = new Result();
        $retval->code = ResultCode::SUCCESS;
        $retval->message = '成功';
        $retval->result = [];

        try {
            $root = Dept::where(function ($query) use ($deptName, $status) {
                $query->whereNull('parent_id', 'and');

                if (!empty($deptName)) {
                    $query->whereLike('dept_name|desc', "%{$deptName}%");
                }

                if ($status !== null) {
                    $query->where('status', $status);
                }
            })->orderRaw('if(isnull(order_no),1,0),order_no')->select();

            $data = [];
            $depts = Dept::where(function ($query) use ($deptName, $status) {
                if (!empty($deptName)) {
                    $query->whereLike('dept_name|desc', "%{$deptName}%");
                }

                if ($status !== null) {
                    $query->where('status', $status);
                }
            })->orderRaw('if(isnull(order_no),1,0),order_no')->select();

            foreach ($root as $m) {
                if (!empty($m->parentId)) {
                    continue;
                }

                // $pm = [
                //     'id' => $m->id,
                //     'deptName' => $m->deptName,
                //     'createTime' => $m->createTime,
                //     'desc' => $m->desc,
                //     'parentId' => $m->parentId,
                //     'orderNo' => $m->orderNo,
                //     'status' => $m->status,
                //     'children' => null,
                // ];
                $m['children'] = null;
                $cd = $this->getChildDept($depts, $m->id); // 获取子级
                if (!empty($cd)) {
                    $m['children'] = $cd;
                }
                $data[] = $m;

                array_push($this->ids, $m->id);
            }
            $retval->result = $data;

            unset($root);
            unset($depts);
            unset($data);

            return json($retval);
        } catch (\Exception $ex) {
            $retval->code = ResultCode::ERROR;
            $retval->message = "获取部门列表失败：{$ex->getMessage()}";
            Log::error("{$retval->message}\r\nHead：" . json_encode($this->request->header()) . "\r\nParam：" . json_encode($this->request->param()));
            return json($retval);
        }
    }

    /**
     * @OA\Get(path="/dept/getListByPage",
     *   tags={"部门管理"},
     *   summary="获取部门分页列表",
     *   @OA\Parameter(name="token", in="header", description="token", required=true, @OA\Schema(type="string")),
     *   @OA\Parameter(name="deptName", in="query", description="部门名", @OA\Schema(type="string")),
     *   @OA\Parameter(name="status", in="query", description="状态", @OA\Schema(type="int")),
     *   @OA\Parameter(name="page", in="query", description="第几页", @OA\Schema(type="int",default="1")),
     *   @OA\Parameter(name="pageSize", in="query", description="每页条数", @OA\Schema(type="int",default="20")),
     *   @OA\Response(response="200", description="Dept")
     * )
     */
    public function getListByPage(string $deptName = '', int $status = null, int $page = 1, int $pageSize = 20)
    {
        $retval = new Result();
        $retval->code = ResultCode::SUCCESS;
        $retval->message = '获取部门列表成功';

        try {
            $list = Dept::where(function ($query) use ($deptName, $status) {
                if (!empty($deptName)) {
                    $query->whereLike('dept_name|desc', "%{$deptName}%");
                }

                if ($status !== null) {
                    $query->where('status', $status);
                }
            })->paginate(['page' => $page, 'pageSize' => $pageSize], false);

            $r = [
                'items' => $list->items(),
                'total' => $list->total()
            ];

            $retval->result = $r;

            unset($list);
            unset($r);

            return json($retval);
        } catch (\Exception $ex) {
            $retval->code = ResultCode::ERROR;
            $retval->message = "获取部门列表失败：{$ex->getMessage()}";
            Log::error("{$retval->message}\r\nHead：" . json_encode($this->request->header()) . "\r\nParam：" . json_encode($this->request->param()));
            return json($retval);
        }
    }

    protected function getChildDept($depts, $id)
    {
        $data = [];

        $childs = $depts->where('parent_id', $id)->order('order_no', 'is null asc');
        if (!$childs->isEmpty()) {
            foreach ($childs as $m) {
                // $childData = [
                //     'id' => $m->id,
                //     'deptName' => $m->deptName,
                //     'createTime' => $m->createTime,
                //     'desc' => $m->desc,
                //     'parentId' => $m->parentId,
                //     'orderNo' => $m->orderNo,
                //     'status' => $m->status,
                //     'children' => null,
                // ];
                $m['children'] = null;
                $cd = $this->getChildDept($depts, $m->id);
                if (!empty($cd)) {
                    $m['children'] = $cd;
                }
                $data[] = $m;
            }
        }

        return $data;
    }

    protected function getParentDept($depts, $parentId)
    {
        $data = [];

        $parent = $depts->where('id', $parentId);
        if (!$parent->isEmpty()) {
            foreach ($parent as $m) {
                $pd = [
                    'id' => $m->id,
                    'deptName' => $m->deptName,
                    'createTime' => $m->createTime,
                    'desc' => $m->desc,
                    'parentId' => $m->parentId,
                    'orderNo' => $m->orderNo,
                    'children' => null,
                ];

                if (!empty($m->parentId)) {
                    $cd = $this->getParentDept($depts, $m->parentId);
                    if (!empty($cd)) {
                        $cd['children'] = $pd;
                    }
                    $data[] = $cd;
                } else {
                    $data[] = $pd;
                }
            }
        }

        return $data;
    }

    /**
     * @OA\Post(path="/dept/create",
     *   tags={"部门管理"},
     *   summary="创建部门",
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
            $check = validate(DeptValidate::class)->scene('create')->check($params);
            if (!$check) {
                $retval->code = ResultCode::FAIL;
                $retval->message = "参数验证不通过，请重新录入";
                return json($retval);
            }

            $parentId = $params['parentId'] ?? null;
            $deptName = $params['deptName'];
            $desc = $params['desc'] ?? '';
            $orderNo = $params['orderNo'] ?? null;

            $o = Dept::where('dept_name', $deptName)->findOrEmpty();
            if (!$o->isEmpty()) {
                $retval->code = ResultCode::FAIL;
                $retval->message = "部门名已存在";
                return json($retval);
            }

            $o = Dept::create([
                'parent_id' => $parentId,
                'dept_name'  => $deptName,
                'status'  => $params['status'],
                'desc'  => $desc,
                'order_no' => $orderNo,
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
     * @OA\Put(path="/dept/update",
     *   tags={"部门管理"},
     *   summary="修改部门",
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
            $check = validate(DeptValidate::class)->scene('update')->check($params);
            if (!$check) {
                $retval->code = ResultCode::FAIL;
                $retval->message = "参数验证不通过，请重新录入";
                return json($retval);
            }

            $parentId = $params['parentId'] ?? null;
            $deptName = $params['deptName'];
            $desc = $params['desc'] ?? '';
            $orderNo = $params['orderNo'] ?? null;
            $id = $params['id'];

            $o = Dept::find($id);
            if ($o->deptName != $deptName) {
                $d = Dept::where('dept_name', $deptName)->findOrEmpty();
                if (!$d->isEmpty()) {
                    $retval->code = ResultCode::FAIL;
                    $retval->message = "部门名已存在";
                    return json($retval);
                }
            }

            $o->deptName = $deptName;
            $o->parentId = $parentId;
            $o->status = $params['status'];
            $o->desc = $desc;
            $o->orderNo = $orderNo;
            $o->save();

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
     * @OA\Delete(path="/dept/delete",
     *   tags={"部门管理"},
     *   summary="删除部门",
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
            $ur = UserDept::where('dept_id', $id)->findOrEmpty();
            if (!$ur->isEmpty()) {
                $retval->code = ResultCode::FAIL;
                $retval->message = '此部门已被使用，不能删除';
                return $retval;
            }

            $child = Dept::where('parent_id', $id)
                ->alias('d')
                ->join('user_dept ud', 'ud.dept_id=d.id')
                ->findOrEmpty();
            if (!$child->isEmpty()) {
                $retval->code = ResultCode::FAIL;
                $retval->message = '子部门已被使用，不能删除';
                return $retval;
            }

            Dept::where('parent_id', $id)->delete(); // 删除子部门
            if (!Dept::destroy($id)) {
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
