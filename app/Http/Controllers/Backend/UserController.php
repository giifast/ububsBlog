<?php
namespace App\Http\Controllers\Backend;

use App\Repositories\Backend\UserRepository;
use App\Repositories\Common\DictRepository;
use Ububs\Core\Http\Interaction\Request;

class UserController extends CommonController
{

    // 列表页面
    public function index()
    {
        $input             = Request::get();
        $result            = UserRepository::getInstance()->lists($input);
        $result['options'] = DictRepository::getInstance()->options(['gender']);
        return $this->response($result);
    }

    // 列表
    public function lists()
    {
        $input  = Request::get();
        $result = UserRepository::getInstance()->lists($input);
        return $this->response($result);
    }

    // 详情
    public function show($id)
    {
        $result['list'] = UserRepository::getInstance()->show($id);
        return $this->response($result);
    }

    // 新增
    public function store()
    {
        $input  = Request::post();
        $result = UserRepository::getInstance()->store($input);
        return $this->response($result);
    }

    // 删除
    public function delete($ids)
    {
        $result = UserRepository::getInstance()->delete($ids);
        return $this->response($result);
    }

    // 编辑
    public function update($id)
    {
        $input  = Request::post();
        $result = UserRepository::getInstance()->update($id, $input);
        return $this->response($result);
    }

    // 详情页面
    public function detail($id)
    {
        $result            = UserRepository::getInstance()->show($id);
        $result['options'] = DictRepository::getInstance()->options(['gender']);
        return $this->response($result);
    }

    // 浏览记录
    public function readHistory($id)
    {
        $result = UserRepository::getInstance()->readHistory($id);
        return $this->response($result);
    }

    // 动态记录
    public function activeHistory($id)
    {
        $result = UserRepository::getInstance()->activeHistory($id);
        return $this->response($result);
    }

    // 在线记录
    public function onlineHistory($id)
    {
        $result = UserRepository::getInstance()->onlineHistory($id);
        return $this->response($result);
    }
}
