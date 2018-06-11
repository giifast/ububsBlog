<?php
namespace App\Repositories\Backend;

use Ububs\Core\Component\Db\Db;

class UserRepository extends CommonRepository
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
        $result['lists'] = DB::table('user')->selects(['id', 'account', 'mail', 'gender', 'last_login_time', 'last_login_ip', 'status'])->where($whereParams)->limit($pagination['start'], $pagination['limit'])->get();
        $result['total'] = DB::table('user')->where($whereParams)->count();
        return $result;
    }

    /**
     * 获取一条数据
     * @param  int $id id
     * @return array
     */
    public function show($id)
    {
        $result = DB::table('user')->selects(['id', 'account', 'mail', 'gender', 'status'])->where(['id' => $id])->first();
        return $result;
    }

    /**
     * 新增一条数据
     * @param  array $input 新增内容
     * @return array
     */
    public function store($input)
    {
        if (!$data = $this->validate($input)) {
            return ['code' => ['common', '1003']];
        }
        $result = DB::table('user')->create($data);
        if (!$result) {
            return ['code' => ['common', '1002']];
        }
        return ['message' => ['common', '1001']];
    }

    /**
     * 编辑用户
     * @param  int $id    用户id
     * @param  array $input 更新内容
     * @return array
     */
    public function update($id, $input)
    {
        if (!$data = $this->validate($input, $id)) {
            return ['code' => ['common', '1003']];
        }
        $result = DB::table('user')->where(['id' => $id])->update($data);
        if (!$result) {
            return ['code' => ['common', '3002']];
        }
        return ['message' => ['common', '3001']];
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
            $deleteIdArr = [];
            foreach ($idArr as $id) {
                if ($id && !in_array($id, $deleteIdArr)) {
                    $deleteIdArr[] = $id;
                }
            }
            DB::table('user')->whereIn('id', $deleteIdArr)->delete();
        }
        return [
            'message' => ['common', '2001'],
        ];
    }

    /**
     * 浏览记录
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function readHistory($id)
    {
        $result['list'] = [];
        return $result;
    }

    // 动态记录
    public function activeHistory($id)
    {
        $result['list'] = [];
        return $result;
    }

    // 在线记录
    public function onlineHistory($id)
    {
        $result['list'] = [];
        return $result;
    }

    private function validate($input, $id = null)
    {
        $data = [
            'account' => $input['account'] ?? '',
            'password' => isset($input['password']) ? generatePassword($input['password']) : '',
            'mail'     => $input['mail'] ?? '',
            'gender'   => $input['gender'] ?? 0,
            'status'   => isset($input['status']) ? intval($input['status']) : 0,
        ];
        if (!$data['account']) {
            return false;
        }
        $query = DB::table('user')->where(['account' => $data['account']]);
        // 表示更新
        if ($id) {
            $query = $query->whereNot('id', $id);
        }
        if ($query->exist()) {
            return false;
        }

        $query = DB::table('user')->where(['mail' => $data['mail']]);
        // 表示更新
        if ($id) {
            $query = $query->whereNot('id', $id);
        }
        if ($query->exist()) {
            return false;
        }
        return $data;
    }
}
