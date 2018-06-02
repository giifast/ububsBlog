<?php
namespace App\Repositories\Common;

use FwSwoole\Core\Tool\Config;

class BaseRepository
{
    protected static $instance;

    public static function getInstance()
    {
        $class = get_called_class();
        if (!isset(self::$instance[$class])) {
            self::$instance[$class] = new $class;
        }
        return self::$instance[$class];
    }

    /**
     * 解析 pagination 分页参数
     * @param  json $pagination 分页信息
     * $pagination = [
     * 		'currentPage' => 3, 第几页
     * 		'pageSize' => 10, 每页条数
     * ];
     * @return array
     */
    public function parsePages($pagination)
    {
        if($pagination) {
            $pagination = json_decode($pagination, true);
        }
    	$page = isset($pagination['currentPage']) ? intval($pagination['currentPage']) : 1;
    	$limit = isset($pagination['pageSize']) ? intval($pagination['pageSize']) : intval(config('app.page_size', 10));
    	$result['start'] = ($page - 1) * $limit;
    	$result['limit'] = $limit;
    	return $result;
    }

    /**
     * 解析 where 查询条件
     * @param  array $wheres 查询条件
     * @param  array $additionWheres 需合并的查询条件
     * @return array
     */
    public function parseWheres($wheres, $additionWheres = [])
    {
        $result = [];
        $wheres = array_merge(json_decode($wheres, true), $additionWheres);
        if (empty($wheres)) {
            return $result;
        }
        foreach ($wheres as $field => $item) {
            if (!is_array($item)) {
                $result[$field] = ['=', $item];
                continue;
            }
            if (count($item) === 2) {
                list($condition, $value) = $item;
                if (strtoupper($condition) === 'LIKE') {
                    $value = '%' . $value . '%';
                }
                $result[$field] = [$condition, $value];
            }
        }
        return $result;
    }
}
