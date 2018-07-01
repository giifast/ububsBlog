<?php
namespace App\Repositories\Frontend;

class ArticleRepository extends CommonRepository
{
    // 正常
    const COMMON_STATUS = 10;

    public $table  = 'article';
    public $fields = ['id', 'title', 'created_at'];

    /**
     * 获取列表
     * @param  array $input
     * @return array
     */
    public function lists($input)
    {
        list($fields, $pages, $wheres) = $this->parseParams($input);
        $query                         = $this->getDB()->selects($fields)->where($wheres)->where('status', self::COMMON_STATUS)->orderBy('id', 'desc');
        if (isset($input['pagination'])) {
            $query->pagination($pages);
        }
        $result['lists'] = $query->get();
        $result['total'] = $this->getDB()->where($wheres)->count();
        return $result;
    }
    /**
     * 详情
     * @param  int $id 数据id
     * @return array
     */
    public function show($id)
    {
        $result['list'] = [];
        $list           = $this->getDB()->selects(['id', 'title', 'created_at', 'content'])->where([
            'id'     => $id,
            'status' => self::COMMON_STATUS,
        ])->first();
        if (empty($list)) {
            return $result;
        }
        $result['list']                        = $list;
        list($result['prev'], $result['next']) = [$this->getPrev($id), $this->getNext($id)];
        return $result;
    }

    private function getPrev($id)
    {
        $minId = $this->getDB()->where('status', self::COMMON_STATUS)->min('id');
        do {
            $result = $this->getDB()->selects($this->fields)->where([
                'id'     => --$id,
                'status' => self::COMMON_STATUS,
            ])->first();
        } while (empty($result) && $id > $minId);
        return $result;
    }

    private function getNext($id)
    {
        $maxId = $this->getDB()->where('status', self::COMMON_STATUS)->max('id');
        do {
            $result = $this->getDB()->selects($this->fields)->where([
                'id'     => ++$id,
                'status' => self::COMMON_STATUS,
            ])->first();
        } while (empty($result) && $id < $maxId);
        return $result;
    }
}
