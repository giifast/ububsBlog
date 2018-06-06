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
        $input['password'] = $input['password'] ?? '';
        $saveData = [
            'account' => $input['account'] ?? '',
            'password' => generatePassword($input['password']),
            'mail'     => $input['mail'] ?? '',
            'gender'   => $input['gender'] ?? 0,
            'status'   => isset($input['status']) ? intval($input['status']) : 0,
        ];
        if ($saveData['account'] === '') {
            return ['code' => ['user', '1002']];
        }
        // 用户名不得重复
        if (DB::table('user')->where(['account' => $saveData['account']])->isExist()) {
            return ['code' => ['user', '1005']];
        }
        if ($input['account'] !== '') {
            // 邮箱地址不得重复
            if (DB::table('user')->where(['mail' => $saveData['mail']])->isExist()) {
                return ['code' => ['user', '1006']];
            }
        }
        $result = DB::table('user')->create($saveData);
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
        $editData = [];
        if (isset($input['account'])) {
            if ($input['account'] === '') {
                return ['code' => ['user', '3001']];
            }
            // 用户名不得重复
            if (DB::table('user')->where(['account' => $input['account']])->whereNot(['id' => $id])->isExist()) {
                return ['code' => ['user', '3002']];
            }
            $editData['account'] = $input['account'];
        }
        if (isset($input['password'])) {
            $editData['password'] = generatePassword($input['password']);
        }
        if (isset($input['mail'])) {
            // 邮箱地址不得重复
            if (DB::table('user')->where(['mail' => $input['mail']])->whereNot(['id' => $id])->isExist()) {
                return ['code' => ['user', '3004']];
            }
            $editData['mail'] = $input['mail'];
        }
        if (isset($input['status'])) {
            $editData['status'] = intval($input['status']);
        }
        if (isset($input['gender'])) {
            $editData['gender'] = intval($input['gender']);
        }
        if (empty($editData)) {
            return ['code' => ['user', '3006']];
        }
        $result = DB::table('user')->where(['id' => $id])->update($editData);
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
            DB::table('user')->whereIn([
                'id' => $deleteIdArr,
            ])->delete();
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
}
