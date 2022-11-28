<?php

declare(strict_types=1);

namespace app\controller;

use app\BaseController;
use app\model\User;
use app\model\UserDept;
use app\model\UserRole;
use think\facade\Config;
use think\facade\Filesystem;
use utils\Result;
use enum\ResultCode;
use app\service\TokenService;
use app\validate\UserValidate;
use think\facade\Db;
use think\facade\Log;
use utils\Md5Hash;

/**
 * @OA\Info(title="STCN.FRAMEWORK 接口文档", version="1.0.1")
 */
class UserController extends BaseController
{
    protected function getFileUrl()
    {
        return Config::get('filesystem.disks.public.url');
    }

    /**
     * @OA\Get(path="/user/gettoken",
     *   tags={"用户管理"},
     *   summary="获取Token",
     *   @OA\Parameter(name="username", in="query", description="用户Id或登录名", required=true, @OA\Schema(type="string",default="admin")),
     *   @OA\Parameter(name="password", in="query", description="密钥", required=true, @OA\Schema(type="string",default="12345678")),
     *   @OA\Response(response="200", description="Token")
     * )
     */
    public function getToken($username, $password)
    {
        return $this->login($username, $password);
    }

    /**
     * @OA\Get(path="/user/login",
     *   tags={"用户管理"},
     *   summary="用户登录",
     *   @OA\Parameter(name="username", in="query", description="用户名", required=true, @OA\Schema(type="string",default="admin")),
     *   @OA\Parameter(name="password", in="query", description="密码", required=true, @OA\Schema(type="string",default="12345678")),
     *   @OA\Response(response="200", description="User、Token")
     * )
     */
    public function login($username, $password)
    {
        $retval = new Result();
        $retval->code = ResultCode::SUCCESS;
        $retval->message = '成功';

        try {
            // 验证参数，不通过会抛出异常
            $check = validate(UserValidate::class)->scene('login')->check($this->request->param());
            if (!$check) {
                $retval->code = ResultCode::FAIL;
                $retval->message = "登录验证不通过,请重试或联系管理员";
                return json($retval);
            }

            $user = User::where(['username' => $username])->findOrEmpty();
            if ($user->isEmpty()) { // 不存在
                $retval->code = ResultCode::FAIL;
                $retval->message = "用户名或密码不正确";
                return json($retval);
            }

            if ($user->password !== Md5Hash::simpleHash($password, $user->salt)) { // 密码错误
                $retval->code = ResultCode::FAIL;
                $retval->message = "用户名或密码不正确";
                return json($retval);
            }

            // 登录成功则写入登录时间
            $user->loginTime =  date('Y-m-d h:i:s', time());
            $user->save();

            $roles = [];
            if (!$user->roles->isEmpty()) {
                foreach ($user->roles as $r) {
                    $roles[] = ['roleName' => $r->roleName, 'value' => $r->id];
                }
            }

            $user->avatar = $this->getFileUrl() . $user->avatar;
            $retval = TokenService::getToken($user);
            if ($retval->code === ResultCode::SUCCESS) {
                $retval->result = [
                    'userId' => $user->id,
                    'userCode' => $user->userCode,
                    'userName' => $user->username,
                    'nickname' => $user->nickname,
                    'token' => $retval->result,
                    'role' => $roles
                ];
            }

            return json($retval);
        } catch (\Exception $ex) {
            $retval->code = ResultCode::ERROR;
            $retval->message = "登录失败：{$ex->getMessage()}";
            Log::error("{$retval->message}\r\nHead：" . json_encode($this->request->header()) . "\r\nParam：" . json_encode($this->request->param()));
            return json($retval);
        }
    }

    /**
     * @OA\Get(path="/user/logout",
     *   tags={"用户管理"},
     *   summary="退出登录",
     *   @OA\Parameter(name="token", in="header", description="token", required=true, @OA\Schema(type="string")),
     *   @OA\Response(response="200", description="退出登录")
     * )
     */
    public function logout()
    {
        $retval = new Result();
        $retval->code = ResultCode::SUCCESS;
        $retval->message = '退出登录成功！';

        return $retval;
    }

    public function tokenExpired()
    {
        $retval = new Result();
        $retval->code = ResultCode::SUCCESS;
        $retval->message = '成功！';

        return $retval;
    }

    public function sessionTimeout()
    {
        $retval = new Result();
        $retval->code = ResultCode::SUCCESS;
        $retval->message = '成功！';

        return $retval;
    }

    /**
     * @OA\Get(path="/user/isExist",
     *   tags={"用户管理"},
     *   summary="用户是否存在",
     *   @OA\Parameter(name="token", in="header", description="token", required=true, @OA\Schema(type="string")),
     *   @OA\Parameter(name="userName", in="query", description="用户名", @OA\Schema(type="string")),
     *   @OA\Parameter(name="userCode", in="query", description="工号", @OA\Schema(type="string")),
     *   @OA\Response(response="200", description="User")
     * )
     */
    public function isExist(string $userName, string $userCode = '')
    {
        $retval = new Result();
        $retval->code = ResultCode::SUCCESS;
        $retval->message = '成功';
        $retval->result = false;

        try {
            // $where = [];
            // if (!empty($userName)) {
            //     $where[] = ['username' => $userName];
            // }
            // if (!empty($userCode)) {
            //     $where[] = ['user_code' => $userCode,'or'];
            // }
            $u = User::where(function ($query) use ($userName, $userCode) {
                if (!empty($userName)) {
                    $query->where('username|real_name', $userName);
                }

                if (!empty($userCode)) {
                    $query->whereOr('user_code', $userCode);
                }
            })->findOrEmpty();

            if ($u->isEmpty()) {
                $retval->result = false;
            } else {
                $retval->result = true;
            }

            return json($retval);
        } catch (\Exception $ex) {
            $retval->code = ResultCode::ERROR;
            $retval->message = "失败：{$ex->getMessage()}";
            Log::error("{$retval->message}\r\nHead：" . json_encode($this->request->header()) . "\r\nParam：" . json_encode($this->request->param()));
            return json($retval);
        }
    }

    /**
     * @OA\Get(path="/user/getUserInfo",
     *   tags={"用户管理"},
     *   summary="获取当前用户",
     *   @OA\Parameter(name="token", in="header", description="token", required=true, @OA\Schema(type="string")),
     *   @OA\Response(response="200", description="User")
     * )
     */
    public function getUserInfo()
    {
        $retval = new Result();
        $retval->code = ResultCode::SUCCESS;
        $retval->message = '获取当前用户成功';

        try {
            $token = TokenService::getCurrentUser($this->request);
            Log::debug($token);
            if ($token->code !== ResultCode::SUCCESS) {
                $retval->message = "当前用户不存在，请重新登录！";
                return $retval;
            }

            $user = User::where(['id' => $token->result->id])->findOrEmpty();
            $user->avatar = $this->getFileUrl() . $user->avatar;

            $roles = [];
            if (!$user->roles->isEmpty()) {
                foreach ($user->roles as $r) {
                    //$roles[] = ['roleName' => $r->roleName, 'value' => $r->id];
                    $r['value'] = $r->id; // 前端要求是value,所以要把id转成value
                }
            }

            $deptName = '';
            if (!$user->depts->isEmpty()) {
                foreach ($user->depts as $d) {
                    $deptName .= $d->deptName . " ";
                }
            }

            $retval->result = $user;
            $retval->result['userId'] = $user->id;
            $retval->result['deptName'] = $deptName;
            // $retval->result['roles'] = $roles;

            // $retval->result = [
            //     'userId' => $user->id,
            //     'username' => $user->username,
            //     'realName' => $user->realName,
            //     'nickname' => $user->nickname,
            //     'userCode' => $user->userCode,
            //     'roles' => $roles
            // ];
            return json($retval);
        } catch (\Exception $ex) {
            $retval->code = ResultCode::ERROR;
            $retval->message = "获取当前用户失败：{$ex->getMessage()}";
            Log::error("{$retval->message}\r\nHead：" . json_encode($this->request->header()) . "\r\nParam：" . json_encode($this->request->param()));
            return json($retval);
        }
    }

    /**
     * @OA\Get(path="/user/getListByPage",
     *   tags={"用户管理"},
     *   summary="获取用户分页列表",
     *   @OA\Parameter(name="token", in="header", description="token", required=true, @OA\Schema(type="string")),
     *   @OA\Parameter(name="keyword", in="query", description="关键字", @OA\Schema(type="string")),
     *   @OA\Parameter(name="deptId", in="query", description="部门id", @OA\Schema(type="int")),
     *   @OA\Parameter(name="page", in="query", description="第几页", @OA\Schema(type="int",default="1")),
     *   @OA\Parameter(name="pageSize", in="query", description="每页条数", @OA\Schema(type="int",default="20")),
     *   @OA\Response(response="200", description="User")
     * )
     */
    public function getListByPage(string $keyword = '', int $deptId = null, int $page = 1, int $pageSize = 20)
    {
        $retval = new Result();
        $retval->code = ResultCode::SUCCESS;
        $retval->message = '获取用户列表成功';

        try {
            $user = User::where(function ($query) use ($keyword, $deptId) {
                if (!empty($keyword)) {
                    $query->whereLike('username|real_name|nickname|user_code|gender|email|mobile|job|wechat_id|u.desc', "%{$keyword}%");
                }

                if (!empty($deptId) && $deptId != 1) {
                    $query->where('ud.dept_id', $deptId);
                }
            })
                ->alias('u')
                ->leftJoin('user_dept ud', 'ud.user_id=u.id')
                ->field('u.*')
                ->orderRaw('if(isnull(u.order_no),1,0),u.order_no,u.real_name,u.create_time desc')
                ->distinct()
                ->paginate($pageSize, false, ['page' => $page]);
            //->page($page, $pageSize) 用这个分页 total()会出错

            foreach ($user->items() as $m) {
                $m->avatar = $this->getFileUrl() . $m->avatar; // 头像url要把资源文件服务的url也加上
                if (!$m->roles->isEmpty()) {
                    $roles = [];
                    $roleName = '';
                    foreach ($m->roles as $r) {
                        $roles[] = $r->id;
                        //array_push($roles, $r->id);
                        $roleName .= $r->roleName . " ";
                    }
                    $m['roleId'] = $roles;
                    $m['roleName'] = $roleName;
                }

                if (!$m->depts->isEmpty()) {
                    $depts = [];
                    $deptName = '';
                    foreach ($m->depts as $d) {
                        $depts[] = $d->id;
                        $deptName .= $d->deptName . " ";
                    }
                    $m['deptId'] = $depts;
                    $m['deptName'] = $deptName;
                }
            }

            $r = [
                'items' => $user->items(),
                'total' => count($user) // $user->total() 关联查询时这个值不对，是查询关联出来的条数而不是最终结果条数，得用count
            ];
            $retval->result = $r;

            return json($retval);
        } catch (\Exception $ex) {
            $retval->code = ResultCode::ERROR;
            $retval->message = "获取用户列表失败：{$ex->getMessage()}";
            Log::error("{$retval->message}\r\nHead：" . json_encode($this->request->header()) . "\r\nParam：" . json_encode($this->request->param()));
            return json($retval);
        }
    }

    /**
     * @OA\Post(path="/user/create",
     *   tags={"用户管理"},
     *   summary="创建用户",
     *   @OA\Parameter(name="token", in="header", description="token", required=true, @OA\Schema(type="string")),
     *   @OA\Parameter(name="params", in="query", description="User对象", required=true, @OA\Schema(type="object")),
     *   @OA\Response(response="200", description="true")
     * )
     */
    public function create($params)
    {
        $retval = new Result();
        $retval->code = ResultCode::SUCCESS;
        $retval->message = '创建用户成功';

        try {
            // 验证参数，不通过会抛出异常
            $check = validate(UserValidate::class)->scene('create')->check($params);
            if (!$check) {
                $retval->code = ResultCode::FAIL;
                $retval->message = "参数验证不通过，请重新录入";
                return json($retval);
            }

            $userName = $params['username'];
            $userCode = $params['userCode'];

            $u = User::where('username', $userName)->findOrEmpty();
            if (!$u->isEmpty()) {
                $retval->code = ResultCode::FAIL;
                $retval->message = "用户名已存在";
                return json($retval);
            }

            $u = User::where('user_code', $userCode)->findOrEmpty();
            if (!$u->isEmpty()) {
                $retval->code = ResultCode::FAIL;
                $retval->message = "工号已存在";
                return json($retval);
            }

            // $ext = $this->isExist($userName, $userCode)->getData();
            // if($ext->result){
            //     $retval->code = ResultCode::FAIL;
            //     $retval->message = "用户名或工号已存在";
            //     return json($retval);
            // }

            $nickname = $params['nickname'] ?? '';
            $wechatId = $params['wechatId'] ?? '';
            $mobile = $params['mobile'] ?? '';
            $email = $params['email'] ?? '';
            $desc = $params['desc'] ?? '';
            $deptId = $params['deptId'] ?? null;
            $roleId = $params['roleId'] ?? null;
            $orderNo = $params['orderNo'] ?? null;
            $birthday = $params['birthday'] ?? null;

            $salt = Md5Hash::saltRandom();
            // 启动事务
            Db::startTrans();
            $user = User::create([
                'user_code'  => $userCode,
                'username'  => $userName,
                'salt'  => $salt,
                'password'  => Md5Hash::simpleHash($params['password'], $salt),
                'nickname'  => $nickname,
                'real_name'  => $params['realName'],
                'wechat_id'  => $wechatId,
                'email'  => $email,
                'gender'  => $params['gender'],
                'status'  => $params['status'],
                'mobile'  => $mobile,
                'desc'  => $desc,
                'order_no' => $orderNo,
                'birthday' => $birthday,
                'effective_time' => date("Y-m-d", strtotime("+20 year"))
            ]);

            if (!empty($roleId)) {
                $roles = [];
                foreach ($roleId as $r) {
                    $roles[] = ['user_id' => $user->id, 'role_id' => (int)$r];
                }
                $ur = new UserRole;
                $ur->saveAll($roles);
            }

            if (!empty($deptId)) {
                $depts = [];
                foreach ($deptId as $d) {
                    $depts[] = ['user_id' => $user->id, 'dept_id' => (int)$d];
                }
                $ud = new UserDept;
                $ud->saveAll($depts);
            }

            // 提交事务
            Db::commit();

            $retval->result = $user;

            return json($retval);
        } catch (\Exception $ex) {
            // 回滚事务
            Db::rollback();

            $retval->code = ResultCode::ERROR;
            $retval->message = "创建用户失败：{$ex->getMessage()}";
            Log::error("{$retval->message}\r\nHead：" . json_encode($this->request->header()) . "\r\nParam：" . json_encode($this->request->param()));
            return json($retval);
        }
    }

    /**
     * @OA\Put(path="/user/update",
     *   tags={"用户管理"},
     *   summary="修改用户",
     *   @OA\Parameter(name="token", in="header", description="token", required=true, @OA\Schema(type="string")),
     *   @OA\Parameter(name="params", in="query", description="User对象", required=true, @OA\Schema(type="object")),
     *   @OA\Response(response="200", description="true")
     * )
     */
    public function update($params)
    {
        Log::debug($params);
        $retval = new Result();
        $retval->code = ResultCode::SUCCESS;
        $retval->message = '修改用户成功';

        try {
            // 验证参数，不通过会抛出异常
            $check = validate(UserValidate::class)->scene('update')->check($params);
            if (!$check) {
                $retval->code = ResultCode::FAIL;
                $retval->message = "参数验证不通过，请重新录入";
                return json($retval);
            }

            $userName = $params['username'];
            $userCode = $params['userCode'];
            $nickname = $params['nickname'] ?? '';
            $wechatId = $params['wechatId'] ?? '';
            $mobile = $params['mobile'] ?? '';
            $email = $params['email'] ?? '';
            $desc = $params['desc'] ?? '';
            $deptId = $params['deptId'] ?? null;
            $roleId = $params['roleId'] ?? null;
            $orderNo = $params['orderNo'] ?? null;
            $id = $params['id'];
            $password = $params['password'] ?? '';
            $birthday = $params['birthday'] ?? null;

            $user = User::find($id);
            if ($user->username != $userName) {
                $u = User::where('username', $userName)->findOrEmpty();
                if (!$u->isEmpty()) {
                    $retval->code = ResultCode::FAIL;
                    $retval->message = "用户名已存在";
                    return json($retval);
                }
            }

            if ($user->userCode != $userCode) {
                $u = User::where('user_code', $userCode)->findOrEmpty();
                if (!$u->isEmpty()) {
                    $retval->code = ResultCode::FAIL;
                    $retval->message = "工号已存在";
                    return json($retval);
                }
            }

            // 启动事务
            Db::startTrans();

            $user->userCode = $userCode;
            $user->username = $userName;
            if ($user->password != $password) {
                $user->password = Md5Hash::simpleHash($password, $user->salt);
            }
            $user->nickname = $nickname;
            $user->realName = $params['realName'];
            $user->wechatId = $wechatId;
            $user->email = $email;
            $user->gender = $params['gender'];
            $user->status = $params['status'];
            $user->mobile = $mobile;
            $user->desc = $desc;
            $user->orderNo = $orderNo;
            $user->birthday = $birthday;
            $user->save();

            UserRole::where(['user_id' => $user->id])->delete();
            if (!empty($roleId)) {
                $roles = [];
                foreach ($roleId as $r) {
                    $roles[] = ['user_id' => $user->id, 'role_id' => (int)$r];
                }
                $ur = new UserRole;
                $ur->saveAll($roles);
            }

            UserDept::where(['user_id' => $user->id])->delete();
            if (!empty($deptId)) {
                $depts = [];
                foreach ($deptId as $d) {
                    $depts[] = ['user_id' => $user->id, 'dept_id' => (int)$d];
                }
                $ud = new UserDept;
                $ud->saveAll($depts);
            }

            // if (!empty($roleId)) {
            //     // $ur = Db::table('user_role')->where('user_id', $user->id)->findOrEmpty();
            //     $ur = UserRole::where('user_id', $user->id)->findOrEmpty();
            //     Log::debug($ur);
            //     if ($ur->isEmpty()) {
            //         UserRole::create(['user_id' => $user->id, 'role_id' => (int)$roleId]);
            //     } else {
            //         // Db::name('user_role')
            //         //     ->where('id', $ur->id)
            //         //     ->update(['role_id' => (int)$roleId]);
            //         UserRole::update(['id' => $ur->id, 'role_id' => (int)$roleId]);
            //         // $ur->roleId = (int)$roleId;
            //         // $ur->force()->save();
            //     }
            // }

            // if (!empty($deptId)) {
            //     // $ud = Db::table('user_dept')->where('user_id', $user->id)->findOrEmpty();
            //     $ud = UserDept::where('user_id', $user->id)->findOrEmpty();
            //     Log::debug($ud);
            //     if ($ud->isEmpty()) {
            //         UserDept::create(['user_id' => $user->id, 'dept_id' => (int)$deptId]);
            //     } else {
            //         // Db::name('user_dept')
            //         //     ->where('id', $ud->id)
            //         //     ->update(['dept_id' => (int)$deptId]);
            //         UserDept::update(['id' => $ud->id, 'dept_id' => (int)$deptId]);
            //         // $ud->deptId = (int)$deptId;
            //         // $ud->force()->save();
            //     }
            // }

            // 提交事务
            Db::commit();

            $retval->result = $user;

            return json($retval);
        } catch (\Exception $ex) {
            // 回滚事务
            Db::rollback();

            $retval->code = ResultCode::ERROR;
            $retval->message = "修改用户失败：{$ex->getMessage()}";
            Log::error("{$retval->message}\r\nHead：" . json_encode($this->request->header()) . "\r\nParam：" . json_encode($this->request->param()));
            return json($retval);
        }
    }

    /**
     * @OA\Put(path="/user/updateUserInfo",
     *   tags={"用户管理"},
     *   summary="修改个人信息",
     *   @OA\Parameter(name="token", in="header", description="token", required=true, @OA\Schema(type="string")),
     *   @OA\Parameter(name="params", in="query", description="User对象", required=true, @OA\Schema(type="object")),
     *   @OA\Response(response="200", description="true")
     * )
     */
    public function updateUserInfo($params)
    {
        Log::debug($params);
        $retval = new Result();
        $retval->code = ResultCode::SUCCESS;
        $retval->message = '修改成功';

        try {
            // 验证参数，不通过会抛出异常
            $check = validate(UserValidate::class)->scene('update')->check($params);
            if (!$check) {
                $retval->code = ResultCode::FAIL;
                $retval->message = "参数验证不通过，请重新录入";
                return json($retval);
            }

            $nickname = $params['nickname'] ?? '';
            $wechatId = $params['wechatId'] ?? '';
            $mobile = $params['mobile'] ?? '';
            $email = $params['email'] ?? '';
            $desc = $params['desc'] ?? '';
            $id = $params['id'];
            $password = $params['password'] ?? '';
            $birthday = $params['birthday'] ?? null;

            $user = User::find($id);

            if ($user->password != $password) {
                $user->password = Md5Hash::simpleHash($password, $user->salt);
            }
            $user->nickname = $nickname;
            $user->wechatId = $wechatId;
            $user->email = $email;
            $user->gender = $params['gender'];
            $user->mobile = $mobile;
            $user->desc = $desc;
            $user->birthday = $birthday;
            $user->save();

            $retval->result = $user;

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
     * @OA\Delete(path="/user/delete",
     *   tags={"用户管理"},
     *   summary="删除用户",
     *   @OA\Parameter(name="token", in="header", description="token", required=true, @OA\Schema(type="string")),
     *   @OA\Parameter(name="id", in="query", description="id", required=true, @OA\Schema(type="int")),
     *   @OA\Response(response="200", description="true")
     * )
     */
    public function delete(int $id)
    {
        $retval = new Result();
        $retval->code = ResultCode::SUCCESS;
        $retval->message = '删除用户成功';

        try {
            $token = TokenService::getCurrentUser($this->request);
            if ($id == $token->result->id) {
                $retval->code = ResultCode::FAIL;
                $retval->message = '当前用户不能删除';
                return $retval;
            }

            // 启动事务
            Db::startTrans();

            UserRole::where('user_id', $id)->delete();
            UserDept::where('user_id', $id)->delete();
            if (!User::destroy($id)) {
                $retval->code = ResultCode::FAIL;
                $retval->message = '删除用户失败';
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
            $retval->message = "删除用户失败：{$ex->getMessage()}";
            Log::error("{$retval->message}\r\nHead：" . json_encode($this->request->header()) . "\r\nParam：" . json_encode($this->request->param()));
            return json($retval);
        }
    }

    /**
     * @OA\Get(path="/user/createMd5",
     *   tags={"用户管理"},
     *   summary="生成md5",
     *   @OA\Parameter(name="str", in="query", description="需要生成md5的字符串", required=true, @OA\Schema(type="string")),
     *   @OA\Parameter(name="salt", in="query", description="key", required=true, @OA\Schema(type="string")),
     *   @OA\Parameter(name="hashIterations", in="query", description="加密次数", required=true, @OA\Schema(type="string",default="3")),
     *   @OA\Response(response="200", description="md5 string")
     * )
     */
    public function createMd5($str, $salt, $hashIterations = 3)
    {
        $retval = new Result();
        $retval->code = ResultCode::SUCCESS;
        $retval->message = '成功';

        $retval->result = Md5Hash::simpleHash($str, $salt, (int)$hashIterations);

        return json($retval);
    }

    /**
     * @OA\Delete(path="/user/uploadAvatar",
     *   tags={"用户管理"},
     *   summary="上传头像",
     *   @OA\Parameter(name="token", in="header", description="token", required=true, @OA\Schema(type="string")),
     *   @OA\Parameter(name="file", in="query", description="file", required=true, @OA\Schema(type="file")),
     *   @OA\Response(response="200", description="true")
     * )
     */
    public function uploadAvatar()
    {
        $retval = new Result();
        $retval->code = ResultCode::SUCCESS;
        $retval->message = '上传成功';

        try {
            $token = TokenService::getCurrentUser($this->request);

            // 获取表单上传文件 例如上传了001.jpg
            $file = request()->file('file');
            // 上传到本地服务器
            $fileName = str_replace("\\", "/", Filesystem::disk('public')->putFile('user-avatar', $file));
            User::update(['id' => $token->result->id, 'avatar' => $fileName]);

            $retval->result = $this->getFileUrl() . $fileName;

            // validate(['image' => 'fileSize:10240|fileExt:jpg|image:200,200,jpg'])
            // ->check($files);
            // $savename = [];
            // foreach ($files as $file) {
            //     $savename[] = \think\facade\Filesystem::putFile('topic', $file);
            // }
        } catch (\Exception $ex) {
            $retval->code = ResultCode::ERROR;
            $retval->message = "上传失败：{$ex->getMessage()}";
            Log::error("{$retval->message}\r\nHead：" . json_encode($this->request->header()) . "\r\nParam：" . json_encode($this->request->param()));
        }

        return json($retval);
    }
}