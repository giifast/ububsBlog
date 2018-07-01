<?php
namespace App\Repositories\Common;

use FwSwoole\Core\Tool\Config;
use Ububs\Core\Component\Db\Db;

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

    public function getDB($table = '')
    {
        if ($table === '') {
            $table = isset($this->table) ? $this->table : '';
        }
        if (!$table) {
            throw new \Exception("Table is empty", 1);
        }
        return DB::table($table);
    }

    /**
     * 解析前端传递的参数
     * @param  array $input 参数
     * @return array
     */
    public function parseParams($input)
    {
        $fields      = isset($input['fields']) ? $input['fields'] : [];
        $pagination  = isset($input['pagination']) ? $input['pagination'] : [];
        $search      = isset($input['search']) ? $input['search'] : [];
        $fieldsR     = $this->parseFields($fields);
        $paginationR = $this->parsePages($pagination);
        $searchR     = $this->parseWheres($search);
        return [$fieldsR, $paginationR, $searchR];
    }

    public function parseFields($fields)
    {
        if (!empty($fields)) {
            return $fields;
        }
        if (isset($this->fields) && !empty($this->fields)) {
            return $this->fields;
        }
        return '*';
    }

    private function getTable()
    {
        return $this->table;
    }

    /**
     * 解析 pagination 分页参数
     * @param  json $pagination 分页信息
     * $pagination = [
     *         'currentPage' => 3, 第几页
     *         'pageSize' => 10, 每页条数
     * ];
     * @return array
     */
    public function parsePages($pagination)
    {
        if ($pagination) {
            $pagination = json_decode($pagination, true);
        }
        $page  = isset($pagination['currentPage']) ? intval($pagination['currentPage']) : 1;
        $limit = isset($pagination['pageSize']) ? intval($pagination['pageSize']) : intval(config('app.page_size', 10));
        return [($page - 1) * $limit, $limit];
    }

    /**
     * 解析 where 查询条件
     * @param  array $wheres 查询条件
     * @param  array $additionWheres 需合并的查询条件
     * @return array
     */
    public function parseWheres($wheres, $addWheres = [])
    {
        if (!is_array($wheres)) {
            $wheres = json_decode($wheres, true);
        }
        $result = [];
        $wheres = array_merge($wheres, $addWheres);
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
                if (strtolower($condition) === 'like') {
                    $value = '%' . $value . '%';
                }
                if (in_array(strtolower($condition), ['between', 'not between'])) {
                    list($start, $end) = $value;
                    if ($start === '' || $end === '') {
                        continue;
                    }
                }
                $result[$field] = [$condition, $value];
            }
        }
        return $result;
    }

}
