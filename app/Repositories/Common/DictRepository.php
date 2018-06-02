<?php
namespace App\Repositories\Common;

use FwSwoole\DB\DB;

class DictRepository extends BaseRepository
{

    /**
     * 获取字典
     * @param  array $code code字段
     * @return array
     */
    public function options($codeArr)
    {
        $result = [];
        $lists = DB::table('dict')->selects(['code', 'text', 'value'])->whereIn(['code' => $codeArr])->where(['status' => 1])->get();
        if (!empty($lists)) {
            foreach ($lists as $key => $item) {
                $result[$item['code']][] = $item;
            }
        }
        return $result;
    }
}
