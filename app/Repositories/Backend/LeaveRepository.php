<?php
namespace App\Repositories\Backend;

use Ububs\Core\Component\Db\Db;

class LeaveRepository extends CommonRepository
{

    public $table  = 'leave_message';
    public $fields = ['id', 'content', 'mail', 'ip_address', 'address', 'created_at', 'status'];

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

    /**
     * 获取一条数据
     * @param  int $id id
     * @return array
     */
    public function show($id)
    {
        $result = DB::table('leave_message')->where(['id' => $id])->first();
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
        $result = DB::table('leave_message')->create($data);
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
            return ['code' => ['common', '3003']];
        }
        $result = DB::table('leave_message')->where(['id' => $id])->update($data);
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
            DB::table('leave_message')->whereIn('id', $deleteIdArr)->delete();
        }
        return [
            'message' => ['common', '2001'],
        ];
    }

    private function validate($input, $id = null)
    {
        if ($id !== null && !$exist = Db::table('leave_message')->where('id', $id)->exist()) {
            return false;
        }
        $data = [
            'status' => isset($input['status']) ? intval($input['status']) : 0,
        ];
        return $data;
    }
}
