<?php
namespace App\Repositories\Backend;

use Ububs\Core\Component\Db\Db;

class AdminRepository extends CommonRepository
{
    /**
     * 获取列表
     * @param  array $input
     * @return array
     */
    public function lists($input)
    {
        $pagination      = isset($input['pagination']) ? $input['pagination'] : [];
        $search          = isset($input['search']) ? $input['search'] : [];
        $pagination      = $this->parsePages($pagination);
        $whereParams     = $this->parseWheres($search);
        $result['lists'] = Db::table('admin')->selects(['id', 'account', 'mail', 'last_login_ip', 'last_login_time', 'status'])->where($whereParams)->limit($pagination['start'], $pagination['limit'])->get();
        $result['total'] = Db::table('admin')->where($whereParams)->count();
        return $result;
    }

    /**
     * 获取一条数据
     * @param  int $id id
     * @return array
     */
    public function show($id)
    {
        $result['list'] = Db::table('admin')->selects(['id', 'account', 'role_id', 'mail', 'last_login_ip', 'last_login_time', 'status'])->where(['id' => $id])->first();
        if (empty($result['list'])) {
            return ['code' => 'common', '5003'];
        }
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
            Db::table('admin')->whereIn('id', $runIds)->delete();
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
        $result = Db::table('admin')->create($data);
        if (!$result) {
            return ['code' => ['common', '1002']];
        }
        return ['message' => ['common', '1001']];
    }

    /**
     * 更新
     * @param  int $id
     * @param  array $input 数据
     * @return array
     */
    public function update($id, $input)
    {
        if (!$exist = Db::table('admin')->where('id', $id)->exist()) {
            return ['code' => ['common', '5003']];
        }
        if (!$data = $this->validate($input, 'update')) {
            return ['code' => ['common', '1003']];
        }
        $result = Db::table('admin')->where('id', $id)->update($data);
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
            'role_id'  => $input['role_id'] ? intval($input['role_id']) : 0,
            'mail'    => $input['mail'] ?? '',
        ];
        if ($password) {
            $result['password'] = $password;
        }
        return $result;
    }
}
