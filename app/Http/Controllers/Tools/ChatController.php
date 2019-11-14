<?php

namespace App\Http\Controllers\Tools;

use App\Repositories\Tools\ChatRepository;
use Ububs\Core\Http\Interaction\Request;

class ChatController extends CommonController
{
    // 列表
    public function lists()
    {
        $input  = Request::get();
        $result = ChatRepository::getInstance()->lists($input);
        return $this->response($result);
    }
    public function store()
    {
        $input  = $this->request('post');
        $result = ChatRepository::getInstance()->store($input);
        return $this->response($result);
    }

    public function show(int $id)
    {
        $result = ChatRepository::getInstance()->show($id);
        return $this->response($result);
    }

    public function chats(int $id)
    {
        $input  = Request::get();
        $result = ChatRepository::getInstance()->chats($id, $input);
        return $this->response($result);
    }
}
