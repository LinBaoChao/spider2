<?php

declare(strict_types=1);

namespace app\controller;

use app\BaseController;
use app\model\Menu;
use app\model\Role;
use app\model\User;
use think\facade\Db;
use utils\Result;
use enum\ResultCode;
use app\service\TokenService;
use think\facade\Log;
use app\validate\MenuValidate;

class MenuController extends BaseController
{
    protected $gmenuIds = array(); // 所有权限菜单的id
    protected $grootMenuIds = []; // 所有权限根菜单的id

    /**
     * @OA\Get(path="/menu/getRouteMenuList",
     *   tags={"功能模块管理"},
     *   summary="获取当前用户所有功能模块（菜单）",
     *   @OA\Parameter(name="token", in="header", description="token", required=true, @OA\Schema(type="string")),
     *   @OA\Response(response="200", description="Menu List")
     * )
     */
    public function getRouteMenuList()
    {
        $retval = new Result();
        $retval->code = ResultCode::SUCCESS;
        $retval->message = '成功';
        $retval->result = [];

        try {
            $token = (object)TokenService::getCurrentUser($this->request);
            if ($token->code !== ResultCode::SUCCESS) {
                $retval->code = ResultCode::FAIL;
                $retval->result = null;
                $retval->message = "当前用户不存在，请重新登录！";
                return $retval;
            }

            $user = $token->result;

            // 获取当前用户权限菜单
            $userMenus = User::where('u.id', $user->id)
                ->where('r.status', 1)
                ->where('m.status', 1)
                ->alias('u')
                ->field('m.id,m.parent_id')
                ->leftJoin('user_role ur', 'ur.user_id=u.id')
                ->leftJoin('role r', 'r.id=ur.role_id')
                ->leftJoin('role_menu rm', 'rm.role_id=r.id')
                ->leftJoin('menu m', 'm.id=rm.menu_id')
                ->group('m.id,m.parent_id')
                ->orderRaw('if(isnull(m.order_no),1,0),m.order_no')
                ->select();
            // return json($retval);

            if ($userMenus->isEmpty()) {
                $retval->code = ResultCode::ERROR;
                $retval->result = null;
                $retval->message = "您没有访问权限，请联系管理员！";
                return json($retval);
            }

            $this->gmenuIds = array();
            $this->grootMenuIds = array();

            $data = [];
            $menus = Menu::where('status', 1)->orderRaw('if(isnull(order_no),1,0),order_no')->select(); // 取出所有菜单到内存中

            // 找出权限树节点id
            foreach ($userMenus as $userMenu) {
                if (!in_array($userMenu->id, $this->gmenuIds)) {
                    array_push($this->gmenuIds, $userMenu->id);
                }

                if (empty($userMenu->parentId)) { // 父id为空则为根节点
                    if (!in_array($userMenu->id, $this->grootMenuIds)) {
                        array_push($this->grootMenuIds, $userMenu->id);
                    }
                } else {
                    $this->getParentId($userMenu->parentId, $menus);
                }
            }

            $rootMenus = $menus->where('is_menu', 1)->where('parent_id', null)->order('order_no', 'is null asc'); // 获取所有根菜单,目的是为了排序 

            foreach ($rootMenus as $rootId) {
                if (!in_array($rootId->id, $this->gmenuIds)) { // 如果不是有权限的则下一个
                    continue;
                }

                $ms = $menus->where('id', $rootId->id)->where('parent_id', null);

                if (!$ms->isEmpty()) {
                    foreach ($ms as $m) {
                        if (!empty($m->parentId)) {
                            continue;
                        }

                        $pm = [
                            'id' => $m->id,
                            'menuName' => $m->menuName,
                            'name' => $m->menuName,
                            'title' => $m->title,
                            'path' => $m->path,
                            'component' => $m->component,
                            'redirect' => $m->redirect,
                            'disabled' => $m->disabled,
                            'orderNo' => $m->orderNo,
                            'hideTab' => false,
                            'type' => $m->type,
                            'level' => $m->level,
                            'parentMenu' => $m->parentId,
                            'meta' => [
                                'title' => $m->title,
                                'icon' => $m->icon,
                                'showMenu' => $m->showMenu,
                                'hideMenu' => $m->showMenu == 1 ? 0 : 1,
                                'hideTab' => false,
                                'hideChildrenInMenu' => $m->hideChildrenInMenu,
                                'currentActiveMenu' => $m->currentActiveMenu,
                                'ignoreKeepAlive' => $m->ignoreKeepAlive,
                            ],
                            'children' => null,
                        ];

                        $cd = $this->getChildMenu($m->id, $menus); // 获取子级菜单
                        if (!empty($cd)) {
                            $pm['children'] = $cd;
                        }
                        $data[] = $pm;
                    }
                }
            }

            $retval->result = $data;
            return json($retval);
        } catch (\Exception $ex) {
            $retval->code = ResultCode::ERROR;
            $retval->message = "获取功能模块失败：{$ex->getMessage()}";
            Log::error("{$retval->message}\r\nHead：" . json_encode($this->request->header()) . "\r\nParam：" . json_encode($this->request->param()));
            return json($retval);
        }
    }

    private function getRouteMenuListOld()
    {
        $retval = new Result();
        $retval->code = ResultCode::SUCCESS;
        $retval->message = '成功';
        $retval->result = [];

        try {
            $token = (object)TokenService::getCurrentUser($this->request);
            if ($token->code !== ResultCode::SUCCESS) {
                $retval->code = ResultCode::FAIL;
                $retval->result = null;
                $retval->message = "当前用户不存在，请重新登录！";
                return $retval;
            }

            $user = $token->result;

            // 获取当前用户权限根菜单
            $userRootMenus = User::where('u.id', $user->id)
                ->where('r.status', 1)
                ->where('m.status', 1)
                ->where('m.is_menu', 1)
                ->whereNull('m.parent_id', 'and')
                ->alias('u')
                ->field('m.id')
                ->leftJoin('user_role ur', 'ur.user_id=u.id')
                ->leftJoin('role r', 'r.id=ur.role_id')
                ->leftJoin('role_menu rm', 'rm.role_id=r.id')
                ->leftJoin('menu m', 'm.id=rm.menu_id')
                ->group('m.id')
                ->order('m.order_no', ' is null asc')
                ->select();
            //var_dump($userRootMenus);

            // 获取当前用户权限菜单
            $userMenus = User::where('u.id', $user->id)
                ->where('r.status', 1)
                ->where('m.status', 1)
                ->alias('u')
                ->field('m.*')
                ->leftJoin('user_role ur', 'ur.user_id=u.id')
                ->leftJoin('role r', 'r.id=ur.role_id')
                ->leftJoin('role_menu rm', 'rm.role_id=r.id')
                ->leftJoin('menu m', 'm.id=rm.menu_id')
                ->distinct()
                ->select();
            //var_dump($userMenus);
            // $retval->result = $userMenus;
            // return json($retval);

            if ($userRootMenus->isEmpty() || $userMenus->isEmpty()) {
                $retval->code = ResultCode::ERROR;
                $retval->result = null;
                $retval->message = "您没有访问权限，请联系管理员！";
                return json($retval);
            }

            $data = [];

            foreach ($userRootMenus as $rootMenu) {
                $ms = $userMenus->where('id', $rootMenu->id)->where('parent_id', null);
                if (!$ms->isEmpty()) {
                    foreach ($ms as $m) {
                        if (!empty($m->parentId)) {
                            continue;
                        }

                        $pm = [
                            'id' => $m->id,
                            'menuName' => $m->menuName,
                            'name' => $m->menuName,
                            'title' => $m->title,
                            'path' => $m->path,
                            'component' => $m->component,
                            'redirect' => $m->redirect,
                            'disabled' => $m->disabled,
                            'orderNo' => $m->orderNo,
                            'hideTab' => false,
                            'type' => $m->type,
                            'level' => $m->level,
                            'parentMenu' => $m->parentId,
                            'meta' => [
                                'title' => $m->title,
                                'icon' => $m->icon,
                                'showMenu' => $m->showMenu,
                                'hideMenu' => $m->showMenu == 1 ? 0 : 1,
                                'hideTab' => false,
                                'hideChildrenInMenu' => $m->hideChildrenInMenu,
                                'currentActiveMenu' => $m->currentActiveMenu,
                                'ignoreKeepAlive' => $m->ignoreKeepAlive,
                            ],
                            'children' => null,
                        ];

                        $cd = $this->getChildMenu($m->id, $userMenus); // 获取子级菜单
                        if (!empty($cd)) {
                            $pm['children'] = $cd;
                        }
                        $data[] = $pm;
                    }
                }

                // array_push($this->gmenuId, $m->id);
            }

            $retval->result = $data;
            return json($retval);
        } catch (\Exception $ex) {
            $retval->code = ResultCode::ERROR;
            $retval->message = "获取功能模块失败：{$ex->getMessage()}";
            Log::error("{$retval->message}\r\nHead：" . json_encode($this->request->header()) . "\r\nParam：" . json_encode($this->request->param()));
            return json($retval);
        }
    }

    protected function getChildMenu($id, $menus)
    {
        $data = [];

        $childs = $menus->where('parent_id', $id)->where('is_menu', 1)->order('order_no', ' is null asc');
        if (!$childs->isEmpty()) {
            foreach ($childs as $m) {
                if (!in_array($m->id, $this->gmenuIds)) { // 如果不是有权限的则下一个
                    continue;
                }

                $childData = [
                    'id' => $m->id,
                    'menuName' => $m->menuName,
                    'name' => $m->menuName,
                    'title' => $m->title,
                    'path' => $m->path,
                    'component' => $m->component,
                    'redirect' => $m->redirect,
                    'disabled' => $m->disabled,
                    'orderNo' => $m->orderNo,
                    'hideTab' => false,
                    'type' => $m->type,
                    'level' => $m->level,
                    'parentMenu' => $m->parentId,
                    'meta' => [
                        'title' => $m->title,
                        'icon' => $m->icon,
                        'showMenu' => $m->showMenu,
                        'hideMenu' => $m->showMenu == 1 ? 0 : 1,
                        'hideTab' => false,
                        'hideChildrenInMenu' => $m->hideChildrenInMenu,
                        'currentActiveMenu' => $m->currentActiveMenu,
                        'ignoreKeepAlive' => $m->ignoreKeepAlive,
                    ],
                    'children' => null,
                ];

                $cd = $this->getChildMenu($m->id, $menus);
                if (!empty($cd)) {
                    $childData['children'] = $cd;
                }
                $data[] = $childData;
            }
        }

        return $data;
    }

    protected function getParentMenu($menus, $parentId)
    {
        $data = [];

        $parent = $menus->where('id', $parentId);
        if (!$parent->isEmpty()) {
            foreach ($parent as $m) {
                //array_push($this->gmenuId, $m->id);
                $pd = [
                    'id' => $m->id,
                    'menuName' => $m->menuName,
                    'name' => $m->menuName,
                    'title' => $m->title,
                    'path' => $m->path,
                    'component' => $m->component,
                    'redirect' => $m->redirect,
                    'disabled' => $m->disabled,
                    'orderNo' => $m->orderNo,
                    'type' => $m->type,
                    'level' => $m->level,
                    'parentMenu' => $m->parentId,
                    'meta' => [
                        'title' => $m->title,
                        'icon' => $m->icon,
                        'showMenu' => $m->showMenu,
                        'hideMenu' => $m->showMenu == 1 ? 0 : 1,
                        'hideChildrenInMenu' => $m->hideChildrenInMenu,
                        'currentActiveMenu' => $m->currentActiveMenu,
                        'ignoreKeepAlive' => $m->ignoreKeepAlive,
                    ],
                    'children' => null,
                ];

                if (!empty($m->parentId)) {
                    $cd = $this->getParentMenu($menus, $m->parentId);
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
     * @OA\Get(path="/menu/getMenuPermission",
     *   tags={"功能模块管理"},
     *   summary="获取功能模块列表",
     *   @OA\Parameter(name="token", in="header", description="token", required=true, @OA\Schema(type="string")),
     *   @OA\Parameter(name="menuName", in="query", description="模块名称", @OA\Schema(type="string")),
     *   @OA\Parameter(name="status", in="query", description="状态", @OA\Schema(type="int")),
     *   @OA\Response(response="200", description="Menu")
     * )
     */
    public function getMenuPermission(string $menuName = '', int $status = null)
    {
        $retval = new Result();
        $retval->code = ResultCode::SUCCESS;
        $retval->message = '获取列表成功';
        $retval->result = [];

        try {
            $root = Menu::where(function ($query) use ($menuName, $status) {
                $query->whereNull('parent_id', 'and');

                if (!empty($menuName)) {
                    $query->whereLike('menu_name|title', "%{$menuName}%");
                }

                if ($status !== null) {
                    $query->where('status', $status);
                }
            })->orderRaw('if(isnull(order_no),1,0),order_no')->select();

            $menus = Menu::where(function ($query) use ($menuName, $status) {
                if (!empty($menuName)) {
                    $query->whereLike('menu_name|title', "%{$menuName}%");
                }

                if ($status !== null) {
                    $query->where('status', $status);
                }
            })->orderRaw('if(isnull(order_no),1,0),order_no')->select();

            $data = [];

            foreach ($root as $m) {
                if (!empty($m->parentId)) {
                    continue;
                }

                $pm = [
                    'id' => $m->id,
                    'name' => $m->menuName,
                    'menuName' => $m->menuName,
                    'title' => $m->title,
                    'path' => $m->path,
                    'component' => $m->component,
                    'redirect' => $m->redirect,
                    'disabled' => $m->disabled,
                    'orderNo' => $m->orderNo,
                    'type' => $m->type,
                    'level' => $m->level,
                    'parentMenu' => $m->parentId, // 因为是根菜单，所以这个值实际上是空
                    'icon' => $m->icon,
                    'showMenu' => $m->showMenu,
                    'hideMenu' => $m->showMenu == 1 ? 0 : 1,
                    'isMenu' => $m->isMenu,
                    'hideChildrenInMenu' => $m->hideChildrenInMenu,
                    'currentActiveMenu' => $m->currentActiveMenu,
                    'ignoreKeepAlive' => $m->ignoreKeepAlive,
                    'createTime' => $m->createTime,
                    'permission' => $m->menuCode,
                    'children' => null,
                    'status' => $m->status,
                ];

                $cd = $this->getChildMenuPermission($menus, $m->id); // 获取子级
                if (!empty($cd)) {
                    $pm['children'] = $cd;
                }
                $data[] = $pm;

                // array_push($this->gmenuId, $m->id);
            }

            $retval->result = $data;
            return json($retval);
        } catch (\Exception $ex) {
            $retval->code = ResultCode::ERROR;
            $retval->message = "获取列表失败：{$ex->getMessage()}";
            Log::error("{$retval->message}\r\nHead：" . json_encode($this->request->header()) . "\r\nParam：" . json_encode($this->request->param()));
            return json($retval);
        }
    }

    protected function getChildMenuPermission($menus, $id)
    {
        $data = [];

        $childs = $menus->where('parent_id', $id)->order('order_no', ' is null asc');
        if (!$childs->isEmpty()) {
            foreach ($childs as $m) {
                $childData = [
                    'id' => $m->id,
                    'name' => $m->menuName,
                    'menuName' => $m->menuName,
                    'title' => $m->title,
                    'path' => $m->path,
                    'component' => $m->component,
                    'redirect' => $m->redirect,
                    'disabled' => $m->disabled,
                    'orderNo' => $m->orderNo,
                    'type' => $m->type,
                    'level' => $m->level,
                    'parentMenu' => $m->parentId,
                    'icon' => $m->icon,
                    'hideMenu' => $m->showMenu == 1 ? 0 : 1,
                    'showMenu' => $m->showMenu,
                    'isMenu' => $m->isMenu,
                    'hideChildrenInMenu' => $m->hideChildrenInMenu,
                    'currentActiveMenu' => $m->currentActiveMenu,
                    'ignoreKeepAlive' => $m->ignoreKeepAlive,
                    'createTime' => $m->createTime,
                    'permission' => $m->menuCode,
                    'children' => null,
                    'status' => $m->status,
                ];

                $cd = $this->getChildMenuPermission($menus, $m->id);
                if (!empty($cd)) {
                    $childData['children'] = $cd;
                }

                $data[] = $childData;
            }
        }

        return $data;
    }

    /**
     * @OA\Post(path="/menu/create",
     *   tags={"功能模块管理"},
     *   summary="创建功能",
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
            $check = validate(MenuValidate::class)->scene('create')->check($params);
            if (!$check) {
                $retval->code = ResultCode::FAIL;
                $retval->message = "参数验证不通过，请重新录入";
                return json($retval);
            }

            $type = $params['type'];
            $level = $type;
            $parentId = $params['parentMenu'] ?? null;
            $menuName = $params['menuName'] ?? '';
            $menuCode = $params['permission'];
            $title = $params['title'];

            $o = Menu::where(
                'menu_code',
                $menuCode
            )->findOrEmpty();
            if (!$o->isEmpty()) {
                $retval->code = ResultCode::FAIL;
                $retval->message = "权限标识已存在";
                return json($retval);
            }

            $mret = Menu::create([
                'parent_id' => $parentId,
                'menu_name' => $menuName,
                'menu_code' => $menuCode,
                'title' => $title,
                'desc' => $title,
                'status' => $params['status'] ?? 1,
                'disabled' => $params['disabled'] ?? 0,
                'show_menu' => $params['showMenu'] ?? 1,
                'icon' => $params['icon'] ?? '',
                'component' => $params['component'] ?? '',
                'redirect' => $params['redirect'] ?? '',
                'order_no' => $params['orderNo'] ?? null,
                'path' => $params['path'] ?? '',
                'hide_children_in_menu' => $params['hideChildrenInMenu'] ?? 0,
                'type' => $type,
                'level' => $level,
                'is_menu' => $params['isMenu'] ?? 0,
            ]);

            $retval->result = $mret;

            return json($retval);
        } catch (\Exception $ex) {
            $retval->code = ResultCode::ERROR;
            $retval->message = "创建失败：{$ex->getMessage()}";
            Log::error("{$retval->message}\r\nHead：" . json_encode($this->request->header()) . "\r\nParam：" . json_encode($this->request->param()));
            return json($retval);
        }
    }

    /**
     * @OA\Put(path="/menu/update",
     *   tags={"功能模块管理"},
     *   summary="功能修改",
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
            $check = validate(MenuValidate::class)->scene('update')->check($params);
            if (!$check) {
                $retval->code = ResultCode::FAIL;
                $retval->message = "参数验证不通过，请重新录入";
                return json($retval);
            }

            $id = $params['id'];
            $parentId = $params['parentMenu'] ?? null;
            $type = $params['type'];
            $level = $type;
            $menuName = $params['menuName'] ?? null;
            $menuCode = $params['permission'];
            $title = $params['title'];
            $icon = $params['icon'] ?? '';

            $mret = Menu::where('id', $id)->findOrEmpty();
            if ($mret->menuCode != $menuCode) {
                $o = Menu::where('menu_code', $menuCode)->findOrEmpty();
                if (!$o->isEmpty()) {
                    $retval->code = ResultCode::FAIL;
                    $retval->message = "权限标识已存在";
                    return json($retval);
                }
            }

            $mret = Menu::update([
                'id' => $mret->id,
                'parent_id' => $parentId,
                'menu_name' => $menuName,
                'menu_code' => $menuCode,
                'title' => $title,
                'desc' => $title,
                'status' => $params['status'] ?? 0,
                'disabled' => $params['disabled'] ?? 0,
                'show_menu' => $params['showMenu'] ?? 0,
                'icon' => $icon,
                'component' => $params['component'] ?? '',
                'redirect' => $params['redirect'] ?? '',
                'order_no' => $params['orderNo'] ?? null,
                'path' => $params['path'] ?? '',
                'hide_children_in_menu' => $params['hideChildrenInMenu'] ?? 0,
                'level' => $level,
                'type' => $type,
                'is_menu' => $params['isMenu'] ?? 0,
            ]);

            $retval->result = $mret;

            return json($retval);
        } catch (\Exception $ex) {
            $retval->code = ResultCode::ERROR;
            $retval->message = "修改失败：{$ex->getMessage()}";
            Log::error("{$retval->message}\r\nHead：" . json_encode($this->request->header()) . "\r\nParam：" . json_encode($this->request->param()));
            return json($retval);
        }
    }

    /**
     * @OA\Delete(path="/menu/delete",
     *   tags={"功能模块管理"},
     *   summary="删除模块",
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
            $o = Menu::where('m.id', $id)
                ->alias('m')
                ->join('role_menu rm', 'rm.menu_id=m.id')
                ->findOrEmpty();
            if (!$o->isEmpty()) {
                $retval->code = ResultCode::FAIL;
                $retval->message = '此功能已被分配，不能删除';
                return $retval;
            }

            $o = Menu::where('m.parent_id', $id)
                ->alias('m')
                ->join('role_menu rm', 'rm.menu_id=m.id')
                ->findOrEmpty();
            if (!$o->isEmpty()) {
                $retval->code = ResultCode::FAIL;
                $retval->message = '子功能已被分配，不能删除';
                return $retval;
            }

            Db::startTrans();

            Menu::where('parent_id', $id)->delete(); // 删除子
            if (!Menu::destroy($id)) {
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
     * @OA\Get(path="/menu/getPermissionCode",
     *   tags={"功能模块管理"},
     *   summary="获取当前用户所有功能模块编码",
     *   @OA\Parameter(name="token", in="header", description="token", required=true, @OA\Schema(type="string")),
     *   @OA\Response(response="200", description="Permission Code List")
     * )
     */
    public function getPermissionCode()
    {
        $retval = new Result();
        $retval->code = ResultCode::SUCCESS;
        $retval->message = '成功！';
        $retval->result = [];

        $token = (object)TokenService::getCurrentUser($this->request);
        if ($token->code !== ResultCode::SUCCESS) {
            $retval->result = [];
            $retval->message = "当前用户不存在，请重新登录！";
            return $retval;
        }

        $perCode = [];
        $user = User::find($token->result->id);
        if (!empty($user) && !$user->roles->isEmpty()) {
            foreach ($user->roles as $r) {
                $role = Role::where(['id' => $r->id])->findOrEmpty();
                if (!$role->isEmpty() && !$role->menus->isEmpty()) {
                    foreach ($role->menus as $p) {
                        if (!in_array($p->menuCode, $perCode)) {
                            $perCode[] = $p->menuCode;
                        }
                    }
                }
            }
        }

        //Log::debug($perCode);
        $retval->result = $perCode;
        return json($retval);
    }

    protected function getParentId($id, $menus)
    {
        if (!in_array($id, $this->gmenuIds)) {
            array_push($this->gmenuIds, $id);
        }

        $parent = $menus->where('id', $id);
        if (!$parent->isEmpty()) {
            foreach ($parent as $p) {
                if (empty($p->parentId)) { // 父id为空则为根节点
                    if (!in_array($p->id, $this->grootMenuIds)) {
                        array_push($this->grootMenuIds, $p->id);
                    }
                } else {
                    $this->getParentId($p->parentId, $menus);
                }
            }
        }
    }
}
