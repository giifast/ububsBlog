<?php
namespace App\Repositories\Backend;

use Ububs\Core\Component\Auth\Auth;
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
        $pagination      = isset($input['pagination']) ? $input['pagination'] : '';
        $search          = isset($input['search']) ? $input['search'] : '';
        $pagination      = $this->parsePages($pagination);
        $wheres          = $this->parseWheres($search);
        $result['lists'] = Db::table('article')->selects(['id', 'title', 'category_menu_id', 'author', 'created_at', 'status'])->where($wheres)->limit($pagination['start'], $pagination['limit'])->get();
        $result['total'] = Db::table('article')->where($wheres)->count();
        return $result;
    }

    /**
     * 获取文章相关 options
     * @return array
     */
    public function options()
    {
        $uid                     = Auth::id();
        $result['tags']          = Db::table('tag')->selects(['id', 'name'])->get();
        $result['categoryMenus'] = Db::table('category_menu')->get();
        return $result;
    }

    /**
     * 详情
     * @param  int $id 数据id
     * @return array
     */
    public function show($id)
    {
        $result['list'] = Db::table('article')->selects(['title', 'content', 'category_menu_id', 'author', 'creator', 'thumbnail', 'created_at', 'reprinted', 'status'])->where('id', $id)->first();
        // 获取标签
        if (empty($result['list'])) {
            return ['code' => ['article', '4001']];
        }
        $result['list']['user'] = Db::table('admin')->selects(['id', 'account'])->where('id', $result['list']['creator'])->first();

        // 文章关联tag标签
        $tagLists = Db::table('article_tag')->selects(['tag_id'])->where('article_id', $id)->get();
        if (empty($tagLists)) {
            return $result;
        }
        $tagLists = Db::table('tag')->selects(['id'])->whereIn('id', array_column($tagLists, 'tag_id'))->get();
        if (!empty($tagLists)) {
            $result['list']['tags'] = array_column($tagLists, 'id');
        }
        return $result;
    }

    /**
     * 新增
     * @param  array $input 新增内容
     * @return array
     */
    public function store($input)
    {
        if (!$data = $this->validate($input)) {
            return ['code' => ['common', '1003']];
        }
        $id = Db::table('article')->create($data);
        // 文章标签
        if (isset($input['tags']) && !empty($input['tags'])) {
            $tagData = [];
            foreach ($input['tags'] as $tag) {
                $tagData[] = [
                    'article_id' => $id,
                    'tag_id'     => $tag,
                ];
            }
            Db::table('article_tag')->insert($tagData);
        }
        return ['message' => ['common', '1001']];
    }

    /**
     * 加入回收站一条或多条数据
     * @param  string $ids 待处理的数据id
     * @return array
     */
    public function recycle($ids)
    {
        $idArr = explode(',', $ids);
        if (!empty($idArr)) {
            $deleteIdArr = [];
            foreach ($idArr as $id) {
                if ($id && !in_array($id, $deleteIdArr)) {
                    $deleteIdArr[] = $id;
                }
            }
            Db::table('article')->whereIn('id', $deleteIdArr)->update([
                'deleted_at' => time(),
                'status'     => self::RECYCLE_STATUS,
            ]);
        }
        return [
            'message' => ['common', '5001'],
        ];
    }

    /**
     * 移出回收站一条或多条数据
     * @param  string $ids 待处理的数据id
     * @return array
     */
    public function recover($ids)
    {
        $idArr = explode(',', $ids);
        if (!empty($idArr)) {
            $runIds = [];
            foreach ($idArr as $id) {
                if ($id && !in_array($id, $runIds)) {
                    $runIds[] = $id;
                }
            }
            Db::table('article')->whereIn('id', $runIds)->update([
                'deleted_at' => 0,
                'status'     => self::DRAFT_STATUS,
            ]);
        }
        return [
            'message' => ['common', '5001'],
        ];
    }

    /**
     * 删除一条或多条数据
     * @param  string $ids 待处理的数据id
     * @return array
     */
    public function delete($ids)
    {
        $idArr = explode(',', $ids);
        if (!empty($idArr)) {
            $runIds = [];
            foreach ($idArr as $id) {
                if ($id && !in_array($id, $runIds)) {
                    $runIds[] = $id;
                }
            }
            Db::table('article')->whereIn('id', $runIds)->delete();
        }
        return [
            'message' => ['common', '2001'],
        ];
    }

    /**
     * 编辑
     * @param  int $id    文章id
     * @param  array $input 更新内容
     * @return array
     */
    public function update($id, $input)
    {
        if (!Db::table('article')->where(['id' => $id])->exist()) {
            return ['code' => ['article', '3001']];
        }
        if (!$data = $this->validate($input)) {
            return ['code' => ['common', '1003']];
        }

        Db::table('article')->where(['id' => $id])->update($data);
        // 文章标签
        $tags = $oTags = [];
        if (isset($input['tags']) && !empty($input['tags'])) {
            $tags = $input['tags'];
        }

        $tagLists = Db::table('article_tag')->selects(['tag_id'])->where(['article_id' => $id])->get();
        if (!empty($tagLists)) {
            $oTags = array_column($tagLists, 'tag_id');
        }
        // 比较两次tag是否有不同，相同不做处理，不同直接删除所有标签，重新生成
        if (!empty(array_diff($tags, $oTags))) {
            Db::table('article_tag')->where(['article_id' => $id])->delete();
            $tagData = [];
            foreach ($tags as $tag) {
                $tagData[] = [
                    'article_id' => $id,
                    'tag_id'     => $tag,
                ];
            }
            Db::table('article_tag')->insert($tagData);
        }

        return ['message' => ['common', '3001']];
    }

    /**
     * 验证
     * @param  array $input 数据
     * @return boolean | array
     */
    private function validate($input)
    {
        $data = [
            'title'            => $input['title'] ?? '',
            'content'          => isset($input['content']) ? $input['content'] : '',
            'author'           => $input['author'] ?? '',
            'creator'          => Auth::getInstance('admin')->id(),
            'created_at'       => (isset($input['created_at']) && $input['created_at']) ? strtotime($input['created_at']) : time(),
            'category_menu_id' => $input['category_menu_id'] ?? 0,
            'thumbnail'        => $input['thumbnail'] ?? '',
            'reprinted'        => isset($input['reprinted']) ? (int) $input['reprinted'] : 0,
            'status'           => $input['status'] ?? 0
        ];
        // 草稿无需校验
        if (isset($input['draft']) && $input['draft']) {
            $data['status'] = self::DRAFT_STATUS;
            return $data;
        }

        if (!$data['title'] || !$data['content'] || !$data['category_menu_id']) {
            return false;
        }

        return $data;
    }
}
