<?php
namespace App\Repositories\Backend;

use Ububs\Core\Component\Db\Db;

class RoleRepository extends CommonRepository
{
    public $table = 'role';
    public $fields = ['id', 'name', 'status'];

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
            $dIds = [];
            foreach ($idArr as $id) {
                if ($id && !in_array($id, $dIds)) {
                    $dIds[] = $id;
                }
            }
            DB::table('role')->whereIn('id', $dIds)->delete();
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