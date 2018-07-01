<?php
namespace App\Http\Controllers\Backend;

use App\Repositories\Backend\AdminRepository;
use App\Repositories\Backend\RoleRepository;
use Ububs\Core\Http\Interaction\Request;

class AdminController extends CommonController
{
    // 列表页面
    public function index()
    {
        $input  = $this->request('get');
        $result = AdminRepository::getInstance()->lists($input);
        return $this->response($result);
    }

    // 列表
    public function lists()
    {
        $input  = $this->request('get');
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
        return $this->response($result);
    }

    // 编辑
    public function update($id)
    {
        $input  = $this->request('post');
        $result = AdminRepository::getInstance()->update($id, $input);
        return $this->response($result);
    }

    // 新增
    public function store()
    {
        $input  = $this->request('post');
        $result = AdminRepository::getInstance()->store($input);
        return $this->response($result);
    }

    // 详情
    public function show($id)
    {
        $result          = AdminRepository::getInstance()->show($id);
        return $this->response($result);
    }
}
