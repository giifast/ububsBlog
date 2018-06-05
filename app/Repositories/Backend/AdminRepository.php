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
        $result['lists'] = DB::table('admin')->selects(['id', 'username', 'mail', 'last_login_ip', 'last_login_time', 'status'])->where($whereParams)->limit($pagination['start'], $pagination['limit'])->get();
        $result['total'] = DB::table('admin')->where($whereParams)->count();
        return $result;
    }

    /**
     * 获取一条数据
     * @param  int $id id
     * @return array
     */
    public function show($id)
    {
        $result['list'] = DB::table('admin')->selects(['admin.id', 'username', 'mail', 'last_login_ip', 'last_login_time', 'admin.status', 'name'])->where(['admin.id' => $id])->first();
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
            $deleteIdArr = [];
            foreach ($idArr as $id) {
                if ($id && !in_array($id, $deleteIdArr)) {
                    $deleteIdArr[] = $id;
                }
            }
            DB::table('admin')->whereIn([
                'id' => $deleteIdArr,
            ])->delete();
        }
        return [
            'message' => ['common', '2001'],
        ];
    }
}