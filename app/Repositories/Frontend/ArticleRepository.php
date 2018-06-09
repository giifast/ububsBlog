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
        $result = Db::table('article')->selects(['title', 'content', 'category_menu_id', 'author', 'creator', 'thumbnail', 'created_at', 'reprinted', 'status'])->where('id', $id)->first();
        // 获取标签
        if (empty($result)) {
            return ['code' => ['article', '4001']];
        }
        $result['user'] = Db::table('admin')->selects(['id', 'account'])->where('id', $result['creator'])->first();

        // 文章关联tag标签
        $result['tags']  = [];
        $articleTagLists = Db::table('article_tag')->selects(['tag_id'])->where('article_id', $id)->get();
        if (empty($articleTagLists)) {
            return ['list' => $result];
        }
        $tagLists = Db::table('tag')->selects(['id'])->whereIn('id', array_column($articleTagLists, 'tag_id'))->get();
        if (empty($tagLists)) {
            return ['list' => $result];
        }
        $result['tags'] = array_column($tagLists, 'id');
        return ['list' => $result];
    }
}
