<?php

declare(strict_types=1);

namespace app\controller;

use app\BaseController;
use think\facade\Filesystem;
use utils\Result;
use enum\ResultCode;
use think\facade\Log;
use utils\Upload;

class UploadController extends BaseController
{
    public function upload()
    {
        $retval = new Result();
        $retval->code = ResultCode::SUCCESS;
        $retval->message = '上传成功';

        try {
            // 获取表单上传文件 例如上传了001.jpg
            $file = request()->file('file');
            // 上传到本地服务器
            $retval->result = Filesystem::disk('public')->putFile('user-avatar', $file);

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

    public function upload2($params)
    {
        $retval = new Result();
        $retval->code = ResultCode::SUCCESS;
        $retval->message = '上传成功';

        try {
            $retval->result = Upload::putSingleImage($params['file']);
        } catch (\Exception $ex) {
            $retval->code = ResultCode::ERROR;
            $retval->message = "上传失败：{$ex->getMessage()}";
            Log::error("{$retval->message}\r\nHead：" . json_encode($this->request->header()) . "\r\nParam：" . json_encode($this->request->param()));
        }

        return json($retval);
    }
}