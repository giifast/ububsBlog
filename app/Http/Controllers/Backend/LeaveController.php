<?php
namespace App\Http\Controllers\Backend;

use App\Repositories\Backend\LeaveRepository;
use App\Repositories\Common\DictRepository;
use Ububs\Core\Http\Interaction\Request;

class LeaveController extends CommonController
{

    public function index()
    {
        $input             = $this->request('get');
        $result            = LeaveRepository::getInstance()->lists($input);
        $result['options'] = DictRepository::getInstance()->options(['gender']);
        return $this->response($result);
    }

    // 列表
    public function lists()
    {
        $input  = $this->request('get');
        $result = LeaveRepository::getInstance()->lists($input);
        return $this->response($result);
    }

    // 详情
    public function show($id)
    {
        $result['list'] = LeaveRepository::getInstance()->show($id);
        return $this->response($result);
    }

    // 删除
    public function delete($ids)
    {
        $result = LeaveRepository::getInstance()->delete($ids);
        return $this->response($result);
    }

    // 编辑
    public function update($id)
    {
        $input  = $this->request('post');
        $result = LeaveRepository::getInstance()->update($id, $input);
        return $this->response($result);
    }

    // 详情页面
    public function detail($id)
    {
        $result            = LeaveRepository::getInstance()->show($id);
        $result['options'] = DictRepository::getInstance()->options(['gender']);
        return $this->response($result);
    }
}
