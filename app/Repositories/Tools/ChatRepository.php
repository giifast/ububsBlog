<?php

namespace App\Repositories\Tools;

use Ububs\Core\Component\Auth\Auth;

class ChatRepository extends CommonRepository
{

    const COMMON_STATUS = 1;

    public $table  = 'chatrooms';
    public $fields = ['id', 'name', 'created_at'];

    public function lists(array $input)
    {
        list($fields, $pages, $wheres) = $this->parseParams($input);
        $result['lists'] = $this->getDB()->selects($fields)->where($wheres)->where('status', self::COMMON_STATUS)->get();
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
            return $result;
        }
        $result['list'] = $list;
        return $result;
    }

    public function store(array $input)
    {
        if (!$data = $this->validate($input)) {
            return ['code' => ['common', '1003']];
        }
        $result = $this->getDB()->create($data);
        if (!$result) {
            return ['code' => ['common', '1002']];
        }
        return ['message' => ['common', '1001']];
    }

    private function validate(array $input)
    {
        if (!isset($input['name']) || !$input['name']) {
            return false;
        }
        $data = [

            'name'             => $input['name'] ?? '',
            'creator'          => Auth::getInstance('admin')->id(),
            'created_at'       => (isset($input['created_at']) && $input['created_at']) ? strtotime($input['created_at']) : time(),
            'status'           => $input['status'] ?? self::COMMON_STATUS,
        ];
        return $data;
    }
}