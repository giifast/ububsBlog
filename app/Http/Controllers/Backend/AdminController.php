<?php
namespace App\Http\Controllers\Backend;

use App\Repositories\Backend\AdminRepository;
use App\Repositories\Backend\AdminPermissionRepository;
use App\Repositories\Common\DictRepository;
use Ububs\Core\Http\Interaction\Request;

class AdminController extends CommonController
{
    // 列表页面
    public function index()
    {
        $input  = Request::get();
        $result = AdminRepository::getInstance()->lists($input);
        return $this->response($result);
    }

    // 列表
    public function lists()
    {
        $input  = Request::get();
        $result = AdminRepository::getInstance()->lists($input);
        return $this->response($result);
    }

    // 详情页面
    public function detail($id)
    {
        $result = AdminRepository::getInstance()->show($id);
        return $this->response($result);
    }

    // 删除
    public function delete($ids)
    {
        $result = AdminRepository::getInstance()->delete($ids);
        return $this->response($result, [
            'type' => 'log',
            'data' => [
                'type'   => 'delete',
                'params' => ['id' => $ids],
            ],
        ]);
    }

    // 编辑
    public function update($id)
    {
        $input  = Request::post();
        $result = AdminRepository::getInstance()->update($id, $input);
        return $this->response($result);
    }
}
