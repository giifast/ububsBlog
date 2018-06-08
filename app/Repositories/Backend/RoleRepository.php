<?php
namespace App\Repositories\Backend;

use Ububs\Core\Component\Db\Db;

class RoleRepository extends CommonRepository
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
        $result['lists'] = DB::table('role')->selects(['id', 'name', 'status'])->where($whereParams)->limit($pagination['start'], $pagination['limit'])->get();
        // 当前角色对应的管理员数
        if (!empty($result['lists'])) {
            $roleIdArr = $roleAdminArr = [];
            foreach ($result['lists'] as $key => $list) {
                $roleIdArr[] = $list['id'];
            }
            $adminLists = DB::table('admin')->selects(['role_id'])->whereIn('role_id', $roleIdArr)->get();
            if (!empty($adminLists)) {
                foreach ($adminLists as $key => $list) {
                    if (!isset($roleAdminArr[$list['role_id']])) {
                        $roleAdminArr[$list['role_id']] = 0;
                    }
                    $roleAdminArr[$list['role_id']] += 1;
                }
            }

            foreach ($result['lists'] as $key => $list) {
                $result['lists'][$key]['adminNumber'] = isset($roleAdminArr[$list['id']]) ? $roleAdminArr[$list['id']] : 0;
            }
        }
        $result['total'] = DB::table('role')->where($whereParams)->count();
        return $result;
    }

    /**
     * 获取一条数据
     * @param  int $id 用户id
     * @return array
     */
    public function detail($id)
    {
        $result['list'] = DB::table('role')->selects(['id', 'name', 'status'])->where(['id' => $id])->first();
        return $result;
    }

    public function store($input)
    {

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
            DB::table('role')->whereIn([
                'id' => $deleteIdArr,
            ])->delete();
        }
        return [
            'message' => ['common', '2001'],
        ];
    }

    public function options()
    {
        return Db::table('role')->selects(['id', 'name', 'menu_ids'])->where([
            'type' => 1,
            'status' => 1
        ])->get();
    }
}