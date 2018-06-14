<?php
namespace App\Repositories\Frontend;

use Ububs\Core\Component\Db\Db;

class ArticleRepository extends CommonRepository
{
    // 已下架
    const NOT_SHOW_STATUS = 0;
    // 正常
    const COMMON_STATUS = 10;
    // 草稿标识
    const DRAFT_STATUS = 20;
    // 回收站标识
    const RECYCLE_STATUS = 30;

    /**
     * 获取列表
     * @param  array $input
     * @return array
     */
    public function lists($input)
    {
        $pagination = isset($input['pagination']) ? $input['pagination'] : [];
        $dbInstance = Db::table('article')->selects(['id', 'title', 'category_menu_id', 'author', 'created_at', 'status'])->where('status', self::COMMON_STATUS)->orderBy('id', 'desc');
        if (!empty($pagination)) {
            $pagination = $this->parsePages($pagination);
            $dbInstance = $dbInstance->limit($pagination['start'], $pagination['limit']);
        }
        $result['lists'] = $dbInstance->get();
        foreach ($result['lists'] as $key => $item) {
            $result['lists'][$key]['created_at'] = date('d M Y', $item['created_at']);
        }
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
        $list = Db::table('article')->selects(['title', 'content', 'created_at'])->where([
            'id' => $id,
            'status' => self::COMMON_STATUS
        ])->first();
        if (empty($list)) {
            return $result;
        }
        $result['list'] = $list;
        // 获取上一篇
        $result['prev'] = $this->getPrev($id);
        // 获取下一篇
        $result['next'] = $this->getNext($id);
        return $result;
    }

    private function getPrev($id)
    {
        return Db::table('article')->selects(['id', 'title'])->where('id', '<', $id)->where('status', self::COMMON_STATUS)->orderBy('id', 'desc')->first();
    }

    private function getNext($id)
    {
        return Db::table('article')->selects(['id', 'title'])->where('id', '>', $id)->where('status', self::COMMON_STATUS)->orderBy('id', 'asc')->first();
    }
}
