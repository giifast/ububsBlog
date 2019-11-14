<?php

namespace App\Repositories\Tools;

use Ububs\Core\Component\Auth\Auth;
use Ububs\Core\Component\Db\Db;

class ChatRepository extends CommonRepository
{

    const COMMON_STATUS = 1;

    public $table  = 'chatrooms';
    public $fields = ['id', 'name', 'created_at'];

    public function lists(array $input)
    {
        list($fields, $pages, $wheres) = $this->parseParams($input);
        $result['lists']               = $this->getDB()->selects($fields)->where($wheres)->where('status', self::COMMON_STATUS)->get();
        $ids                           = array_column($result['lists'], 'id');
        $result['onlines']             = $this->getOnlines($ids);
        return $result;
    }

    public function show(int $id)
    {
        $result['list'] = [];
        $list           = $this->getDB()->selects(['id', 'name', 'created_at'])->where([
            'id'     => $id,
            'status' => self::COMMON_STATUS,
        ])->first();
        if (empty($list)) {
            return ['code' => ['chat', '1001']];
        }
        $result['list'] = $list;
        return $result;
    }

    public function store(array $input)
    {
        if (!$data = $this->validate($input)) {
            return ['code' => ['common', '1003']];
        }
        $data['id'] = $this->getDB()->createGetId($data);
        if (!$data['id']) {
            return ['code' => ['common', '1002']];
        }
        $ret['list'] = $data;
        return $ret;
    }

    public function chats(int $id, array $input)
    {
        list($fields, $pages, $wheres) = $this->parseParams($input);
        $query                         = Db::table('chat_contents')->selects(['id', 'ip', 'content', 'created_at'])->where('rid', $id)->where($wheres)->orderBy('id', 'desc');
        if (isset($input['pagination'])) {
            $query->pagination($pages);
        }
        $result['lists'] = $query->get();
        return $result;
    }

    private function validate(array $input)
    {
        if (!isset($input['name']) || !$input['name']) {
            return false;
        }
        $data = [

            'name'       => $input['name'] ?? '',
            'creator'    => Auth::getInstance('admin')->id(),
            'created_at' => (isset($input['created_at']) && $input['created_at']) ? strtotime($input['created_at']) : time(),
            'status'     => $input['status'] ?? self::COMMON_STATUS,
        ];
        return $data;
    }

    public function getOnlines(array $ids)
    {
        return [];
    }
}
