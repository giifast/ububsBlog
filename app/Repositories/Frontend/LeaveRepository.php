<?php

namespace App\Repositories\Frontend;

use App\Service\ApiService;
use Ububs\Core\Component\Db\Db;

class LeaveRepository extends CommonRepository
{
    // 正常
    const COMMON_STATUS = 1;

    public $table = 'leave_message';
    public $fields = ['id', 'content', 'address', 'created_at'];

    /**
     * 获取列表
     * @param  array $input
     * @return array
     */
    public function lists($input)
    {
        list($fields, $pages, $wheres) = $this->parseParams($input);
        $result['lists']               = $this->getDB()->selects($fields)->where($wheres)->orderBy('id', 'desc')->pagination($pages)->get();
        $result['total']               = $this->getDB()->where($wheres)->count();
        return $result;
    }

    public function store($input)
    {
        if (!$data = $this->validate($input)) {
            return ['code' => ['common', '1003']];
        }
        $result = $this->getDB()->create($data);
        if (!$result) {
            return ['code' => ['leave', '4001']];
        }
        return [
            'data'    => $data,
            'message' => ['leave', '1001'],
        ];
    }

    private function validate($input)
    {
        $content = isset($input['content']) ? $input['content'] : '';
        $mail    = isset($input['mail']) ? $input['mail'] : '';
        if (!$content) {
            return false;
        }
        $ip = getRealIp();
        return [
            'mail'       => addslashes($mail),
            'content'    => addslashes($content),
            'ip_address' => $ip,
            'address'    => ApiService::getAddressByIp($ip),
            'created_at' => time(),
        ];
    }
}
