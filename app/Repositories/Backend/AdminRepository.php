<?php

namespace App\Repositories\Backend;

class AdminRepository extends CommonRepository
{

    public $table  = 'admin';
    public $fields = ['id', 'account', 'role_id', 'mail', 'last_login_ip', 'last_login_time', 'status'];

    /**
     * 获取列表
     * @param  array $input
     * @return array
     */
    public function lists($input)
    {
        list($fields, $pages, $wheres) = $this->parseParams($input);
        $result['lists']               = $this->getDB()->selects($fields)->where($wheres)->pagination($pages)->get();
        $result['total']               = $this->getDB()->where($wheres)->count();
        return $result;
    }

    /**
     * 获取一条数据
     * @param  int $id id
     * @return array
     */
    public function show($id)
    {
        $list = $this->getDB()->selects($this->fields)->where(['id' => $id])->first();
        if (empty($list)) {
            return ['code' => 'common', '5003'];
        }
        $list['roleName'] = $this->getDB('role')->where('id', $list['role_id'])->value('name');
        $result['list']   = $list;
        return $result;
    }

    /**
     * 删除一条或多条数据
     * @param  string $ids 待删除的数据id
     * @return array
     */
    public function delete($ids)
    {
        $idArr = explode(',', $ids);
        if (!empty($idArr)) {
            $runIds = [];
            foreach ($idArr as $id) {
                if ($id && !in_array($id, $runIds)) {
                    $runIds[] = $id;
                }
            }
            $this->getDB()->whereIn('id', $runIds)->delete();
        }
        return [
            'message' => ['common', '2001'],
        ];
    }

    /**
     * 新增
     * @param  array $input 数据
     * @return array
     */
    public function store($input)
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

    public function store_visit_user()
    {
        $t = time();
        $input = [
            'account' => 'visit_' . $t,
            'mail' => $t . '@qq.com',
            'password' => '123123',
            'role_id' => '2',
            'status' => '1'
        ];
        $this->store($input);
        return $input;
    }

    /**
     * 更新
     * @param  int $id
     * @param  array $input 数据
     * @return array
     */
    public function update($id, $input)
    {
        if (!$exist = $this->getDB()->where('id', $id)->exist()) {
            return ['code' => ['common', '5003']];
        }
        if (!$data = $this->validate($input, 'update')) {
            return ['code' => ['common', '1003']];
        }
        $result = $this->getDB()->where('id', $id)->update($data);
        if (!$result) {
            return ['code' => ['common', '3002']];
        }
        return ['message' => ['common', '1001']];
    }

    /**
     * 新增和修改数据验证
     * @param  array $input 数据
     * @param  string $type  类型
     * @return array        验证后的数据
     */
    private function validate($input, $type = 'store')
    {
        $account  = $input['account'] ?? '';
        $password = isset($input['password']) ? generatePassword($input['password']) : '';
        if ($account === '') {
            return false;
        }
        if ($type === 'store' && !$password) {
            return false;
        }
        $result = [
            'account' => $account,
            'status'  => $input['status'] ? intval($input['status']) : 0,
            'role_id' => $input['role_id'] ? intval($input['role_id']) : 0,
            'mail'    => $input['mail'] ?? '',
        ];
        if ($password) {
            $result['password'] = $password;
        }
        return $result;
    }
}
