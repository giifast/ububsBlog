<?php
namespace App\Http\Controllers\Frontend;

use App\Repositories\Frontend\LeaveRepository;
use App\Repositories\Common\DictRepository;
use Ububs\Core\Http\Interaction\Request;

class LeaveController extends CommonController
{

    // 列表
    public function lists()
    {
        $input  = Request::get();
        $result = LeaveRepository::getInstance()->lists($input);
        return $this->response($result);
    }

    public function show($id)
    {
        $result = LeaveRepository::getInstance()->show($id);
        return $this->response($result);
    }

    public function store()
    {
        $input = $this->request('post');
        $result = LeaveRepository::getInstance()->store($input);
        return $this->response($result);
    }
}
