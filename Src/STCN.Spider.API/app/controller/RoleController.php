<?php

declare(strict_types=1);

namespace app\controller;

use app\BaseController;
use app\model\Menu;
use app\model\Role;
use app\model\RoleMenu;
use app\model\User;
use app\model\UserRole;
use think\facade\Db;
use utils\Result;
use enum\ResultCode;
use think\facade\Log;
use app\validate\RoleValidate;

class RoleController extends BaseController
{
    private $gmenuIds = array();

    /**
     * @OA\Get(path="/role/getList",
     *   tags={"角色管理"},
     *   summary="获取角色列表",
     *   @OA\Parameter(name="token", in="header", description="token", required=true, @OA\Schema(type="string")),
     *   @OA\Parameter(name="roleName", in="query", description="角色名称", @OA\Schema(type="string")),
     *   @OA\Parameter(name="status", in="query", description="状态", @OA\Schema(type="int")),
     *   @OA\Response(response="200", description="User")
     * )
     */
    public function getList(string $roleName = '', int $status = null)
    {
        $retval = new Result();
        $retval->code = ResultCode::SUCCESS;
        $retval->message = '获取列表成功';

        try {
            $list = Role::where(function ($query) use ($roleName, $status) {
                if (!empty($roleName)) {
                    $query->whereLike('role_name|desc', "%{$roleName}%");
                }

                if ($status !== null) {
                    $query->where('status', $status);
                }
            })
                ->orderRaw('if(isnull(order_no),1,0),order_no')
                ->select();

            $retval->result = $list;

            return json($retval);
        } catch (\Exception $ex) {
            $retval->code = ResultCode::ERROR;
            $retval->message = "获取列表失败：{$ex->getMessage()}";
            Log::error("{$retval->message}\r\nHead：" . json_encode($this->request->header()) . "\r\nParam：" . json_encode($this->request->param()));
            return json($retval);
        }
    }

    /**
     * @OA\Get(path="/role/getListByPage",
     *   tags={"角色管理"},
     *   summary="按分页获取角色列表",
     *   @OA\Parameter(name="token", in="header", description="token", required=true, @OA\Schema(type="string")),
     *   @OA\Parameter(name="roleName", in="query", description="角色名称", @OA\Schema(type="string")),
     *   @OA\Parameter(name="status", in="query", description="状态", @OA\Schema(type="int")),
     *   @OA\Parameter(name="page", in="query", description="第几页", @OA\Schema(type="int",default="1")),
     *   @OA\Parameter(name="pageSize", in="query", description="每页条数", @OA\Schema(type="int",default="20")),
     *   @OA\Response(response="200", description="User")
     * )
     */
    public function getListByPage(string $roleName = '', int $status = null, int $page = 1, int $pageSize = 20)
    {
        $retval = new Result();
        $retval->code = ResultCode::SUCCESS;
        $retval->message = '获取列表成功';

        try {
            $list = Role::where(function ($query) use ($roleName, $status) {
                if (!empty($roleName)) {
                    $query->whereLike('role_name|desc', "%{$roleName}%");
                }

                if ($status !== null) {
                    $query->where('status', $status);
                }
            })
                ->orderRaw('if(isnull(order_no),1,0),order_no')
                ->paginate(['page' => $page, 'pageSize' => $pageSize], false);

            //$total = $list->total();

            foreach ($list as $lst) {
                $perCode = [];
                if (!$lst->menus->isEmpty()) {
                    foreach ($lst->menus as $p) {
                        $perCode[] = $p->id;
                    }
                    $lst['permission'] = $perCode;
                }
            }

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
     * @OA\Get(path="/role/setStatus",
     *   tags={"角色管理"},
     *   summary="设置角色状态",
     *   @OA\Parameter(name="token", in="header", description="token", required=true, @OA\Schema(type="string")),
     *   @OA\Parameter(name="id", in="query", description="id", @OA\Schema(type="int")),
     *   @OA\Parameter(name="status", in="query", description="状态", @OA\Schema(type="int")),
     *   @OA\Response(response="200", description="User")
     * )
     */
    public function setStatus(int $id, int $status)
    {
        $retval = new Result();
        $retval->code = ResultCode::SUCCESS;
        $retval->message = '设置角色状态成功';

        try {
            $r = Role::update(['status' => $status], ['id' => $id]);

            $retval->result = $r;

            return json($retval);
        } catch (\Exception $ex) {
            $retval->code = ResultCode::ERROR;
            $retval->message = "设置角色状态失败：{$ex->getMessage()}";
            Log::error("{$retval->message}\r\nHead：" . json_encode($this->request->header()) . "\r\nParam：" . json_encode($this->request->param()));
            return json($retval);
        }
    }

    /**
     * @OA\Post(path="/role/create",
     *   tags={"角色管理"},
     *   summary="创建角色",
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
            $check = validate(RoleValidate::class)->scene('create')->check($params);
            if (!$check) {
                $retval->code = ResultCode::FAIL;
                $retval->message = "参数验证不通过，请重新录入";
                return json($retval);
            }

            $roleName = $params['roleName'];
            $desc = $params['desc'] ?? '';
            $orderNo = $params['orderNo'] ?? null;

            $o = Role::where('role_name', $roleName)->findOrEmpty();
            if (!$o->isEmpty()) {
                $retval->code = ResultCode::FAIL;
                $retval->message = "角色名已存在";
                return json($retval);
            }

            // 启动事务
            Db::startTrans();
            $o = Role::create([
                'role_name'  => $roleName,
                'status'  => $params['status'],
                'desc'  => $desc,
                'order_no' => $orderNo,
            ]);

            $permission = $params['permission'] ?? ''; // 实际上是前端menu树的id数组
            if (!empty($permission)) {
                //$menu = Menu::select();
                $add = [];
                //$this->gmenuIds = array();
                foreach ($permission as $p) {
                    $add[] = ['role_id' => $o->id, 'menu_id' => $p];
                    // if (!in_array($p, $this->gmenuIds)) {
                    //     $add[] = ['role_id' => $o->id, 'menu_id' => $p];
                    //     array_push($this->gmenuIds, $p);

                    //     $mu = $menu->where('id', $p);
                    //     if (!$mu->isEmpty()) {
                    //         foreach ($mu as $m) {
                    //             if (!empty($m->parentId)) {
                    //                 $prm = $this->addParentMenu($menu, $m->parentId, $o->id);
                    //                 if (!empty($prm)) {
                    //                     //$add[] = $prm; 会出错，不知道为什么，别的地方可以这么用
                    //                     $add = array_merge($add, $prm);
                    //                 }
                    //             }
                    //         }
                    //     }
                    // }
                }

                $rp = new RoleMenu;
                $rp->saveAll($add);
            }

            // 提交事务
            Db::commit();

            $retval->result = $o;

            return json($retval);
        } catch (\Exception $ex) {
            // 回滚事务
            Db::rollback();

            $retval->code = ResultCode::ERROR;
            $retval->message = "创建失败：{$ex->getMessage()}";
            Log::error("{$retval->message}\r\nHead：" . json_encode($this->request->header()) . "\r\nParam：" . json_encode($this->request->param()));
            return json($retval);
        }
    }

    /**
     * @OA\Put(path="/role/update",
     *   tags={"角色管理"},
     *   summary="修改角色",
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
            $check = validate(RoleValidate::class)->scene('update')->check($params);
            if (!$check) {
                $retval->code = ResultCode::FAIL;
                $retval->message = "参数验证不通过，请重新录入";
                return json($retval);
            }

            $roleName = $params['roleName'];
            $desc = $params['desc'] ?? '';
            $orderNo = $params['orderNo'] ?? null;
            $id = $params['id'];

            $o = Role::find($id);
            if ($o->roleName != $roleName) {
                $r = Role::where('role_name', $roleName)->findOrEmpty();
                if (!$r->isEmpty()) {
                    $retval->code = ResultCode::FAIL;
                    $retval->message = "角色名已存在";
                    return json($retval);
                }
            }

            // 启动事务
            Db::startTrans();

            $o->roleName = $roleName;
            $o->status = $params['status'];
            $o->desc = $desc;
            $o->orderNo = $orderNo;
            $o->save();

            RoleMenu::where('role_id', $id)->delete(); // 先删除
            $permission = $params['permission'] ?? ''; // 实际上是前端menu树的id数组
            if (!empty($permission)) {
                //$menu = Menu::select();
                $add = [];
                //$this->gmenuIds = array();
                foreach ($permission as $p) {
                    $add[] = ['role_id' => $o->id, 'menu_id' => $p];
                    // if (!in_array($p, $this->gmenuIds)) {
                    // $add[] = ['role_id' => $o->id, 'menu_id' => $p];
                    // array_push($this->gmenuIds, $p);

                    // $mu = $menu->where('id', $p);
                    // if (!$mu->isEmpty()) {
                    //     foreach ($mu as $m) {
                    //         if (!empty($m->parentId)) {
                    //             $prm = $this->addParentMenu($menu, $m->parentId, $o->id);
                    //             if (!empty($prm)) {
                    //                 //$add[] = $prm; 会出错，不知道为什么，别的地方可以这么用
                    //                 $add = array_merge($add, $prm);
                    //             }
                    //         }
                    //     }
                    // }
                    // }
                }

                $rp = new RoleMenu;
                $rp->saveAll($add);
            }

            // 提交事务
            Db::commit();

            $retval->result = $o;

            return json($retval);
        } catch (\Exception $ex) {
            // 回滚事务
            Db::rollback();

            $retval->code = ResultCode::ERROR;
            $retval->message = "修改失败：{$ex->getMessage()}";
            Log::error("{$retval->message}\r\nHead：" . json_encode($this->request->header()) . "\r\nParam：" . json_encode($this->request->param()));
            return json($retval);
        }
    }

    /**
     * @OA\Delete(path="/role/delete",
     *   tags={"角色管理"},
     *   summary="删除角色",
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
            $ur = UserRole::where('role_id', $id)->findOrEmpty();
            if (!$ur->isEmpty()) {
                $retval->code = ResultCode::FAIL;
                $retval->message = '此角色已被分配，不能删除';
                return $retval;
            }

            // 启动事务
            Db::startTrans();

            RoleMenu::where('role_id', $id)->delete();
            if (!Role::destroy($id)) {
                $retval->code = ResultCode::FAIL;
                $retval->message = '删除失败';
                Db::rollback();
                return $retval;
            }

            // 提交事务
            Db::commit();

            return json($retval);
        } catch (\Exception $ex) {
            // 回滚事务
            Db::rollback();

            $retval->code = ResultCode::ERROR;
            $retval->message = "删除失败：{$ex->getMessage()}";
            Log::error("{$retval->message}\r\nHead：" . json_encode($this->request->header()) . "\r\nParam：" . json_encode($this->request->param()));
            return json($retval);
        }
    }

    public function addParentMenu($menu, $parentId, $roleId)
    {
        $add = [];

        $parent = $menu->where('id', $parentId);
        if (!$parent->isEmpty()) {
            foreach ($parent as $prn) {
                if (!in_array($prn->id, $this->gmenuIds)) {
                    $add[] = ['role_id' => $roleId, 'menu_id' => $prn->id];
                    array_push($this->gmenuIds, $prn->id);

                    if (!empty($prn->parentId)) {
                        $this->addParentMenu($menu, $prn->parentId, $roleId);
                    }
                }
            }
        }

        return $add;
    }
}
