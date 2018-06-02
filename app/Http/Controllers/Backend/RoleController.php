<?php
namespace App\Http\Controllers\Backend;

use App\Repositories\Backend\RoleRepository;
use Ububs\Core\Http\Interaction\Request;

class RoleController extends CommonController
{
    // 列表页面
    public function index()
    {
        $input  = Request::get();
        $result = RoleRepository::getInstance()->lists($input);
        return $this->response($result);
    }

    // 列表
    public function lists()
    {
        $input  = Request::get();
        $result = RoleRepository::getInstance()->lists($input);
        return $this->response($result);
    }

    // 详情页面
    public function detail($id)
    {
        $result = RoleRepository::getInstance()->detail($id);
        return $this->response($result);
    }

    // 详情页面
    public function show($id)
    {
        $result = RoleRepository::getInstance()->show($id);
        return $this->response($result);
    }

    // 新增
    public function store()
    {
        $input  = Request::post();
        $result = RoleRepository::getInstance()->store($input);
        return $this->response($result, [
            'type' => 'log',
            'data' => [
                'type'   => 'store',
                'params' => $input,
            ],
        ]);
    }

    // 删除
    public function delete($ids)
    {
        $result = RoleRepository::getInstance()->delete($ids);
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
        $result = RoleRepository::getInstance()->update($id, $input);
        return $this->response($result, [
            'type' => 'log',
            'data' => [
                'type'   => 'update',
                'params' => $input,
            ],
        ]);
    }
}
