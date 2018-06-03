<?php
namespace App\Repositories\Frontend;

use Ububs\Core\Component\Auth\Auth;
use Ububs\Core\Component\Db\Db;

class ArticleRepository extends CommonRepository
{
    // 草稿标识
    const DRAFT_STATUS = 40;
    // 推荐标识
    const RECOMMEND_STATUS = 50;
    // 已下架
    const NOT_SHOW_STATUS = 0;
    // dict导航菜单value
    const CATEGORY_VALUE = 10;

    /**
     * 获取列表
     * @param  array $input
     * @return array
     */
    public function lists($input)
    {
        $pagination      = isset($input['pagination']) ? $input['pagination'] : [];
        $pagination      = $this->parsePages($pagination);
        $result['lists'] = Db::table('article')->selects(['id', 'title', 'category_menu_id', 'author', 'create_time', 'status'])->orderBy('id', 'desc')->limit($pagination['start'], $pagination['limit'])->get();
        foreach ($result['lists'] as $key => $item) {
            $result['lists'][$key]['create_time'] = date('d M Y', $item['create_time']);
        }
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
        $result['categoryMenus'] = Db::table('category_menu')->where(['category' => self::CATEGORY_VALUE])->get();
        return $result;
    }

    /**
     * 详情
     * @param  int $id 数据id
     * @return array
     */
    public function show($id)
    {
        $result = Db::table('article')->selects(['title', 'content', 'category_menu_id', 'author', 'creator', 'thumbnail', 'create_time', 'reprinted', 'status'])->where('id', $id)->first();
        // 获取标签
        if (empty($result)) {
            return ['code' => ['article', '4001']];
        }
        $result['user'] = Db::table('admin')->selects(['id', 'username'])->where('id', $result['creator'])->first();

        // 文章关联tag标签
        $result['tags']  = [];
        $articleTagLists = Db::table('article_tags')->selects(['tag_id'])->where('article_id', $id)->get();
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

    /**
     * 新增
     * @param  array $input 新增内容
     * @return array
     */
    public function store($input)
    {
        $saveData = [
            'title'            => $input['title'] ?? '',
            'content'          => isset($input['content']) ? htmlspecialchars($input['content']) : '',
            'author'           => $input['author'] ?? '',
            'creator'          => Auth::guard('admin')->id(),
            'create_time'      => (isset($input['create_time']) && $input['create_time']) ? strtotime($input['create_time']) : time(),
            'category_menu_id' => $input['category_menu_id'] ?? 0,
            'thumbnail'        => $input['thumbnail'] ?? '',
            'reprinted'        => $input['reprinted'] ?? '',
            'status'           => $input['status'] ?? 0,
        ];
        // 草稿无需校验
        if (!isset($input['draft'])) {
            $validateResult = $this->validate($saveData);
            if ($validateResult !== true) {
                return $validateResult;
            }
        } else {
            // 标识草稿
            $saveData['status'] = self::DRAFT_STATUS;
        }
        $resultId = Db::table('article')->create($saveData);
        // 文章标签
        if (isset($input['tags']) && !empty($input['tags'])) {
            $tagSaveData = [];
            foreach ($input['tags'] as $tag) {
                $tagSaveData[] = [
                    'article_id' => $resultId,
                    'tag_id'     => $tag,
                ];
            }
            Db::table('article_tags')->insert($tagSaveData);
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
            Db::table('article')->whereIn([
                'id' => $deleteIdArr,
            ])->update([
                'delete_time' => time(),
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
            $deleteIdArr = [];
            foreach ($idArr as $id) {
                if ($id && !in_array($id, $deleteIdArr)) {
                    $deleteIdArr[] = $id;
                }
            }
            Db::table('article')->whereIn([
                'id' => $deleteIdArr,
            ])->delete();
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
        $isExist = Db::table('article')->where(['id' => $id])->isExist();
        if (!$isExist) {
            return ['code' => ['article', '3001']];
        }
        $saveData = [
            'title'            => $input['title'] ?? '',
            'content'          => isset($input['content']) ? htmlspecialchars($input['content']) : '',
            'author'           => $input['author'] ?? '',
            'category_menu_id' => $input['category_menu_id'] ?? 0,
            'thumbnail'        => $input['thumbnail'] ?? '',
            'reprinted'        => $input['reprinted'] ?? '',
            'status'           => $input['status'] ?? 0,
        ];
        // 草稿无需校验
        if (!isset($input['draft'])) {
            $validateResult = $this->validate($saveData);
            if ($validateResult !== true) {
                return $validateResult;
            }
        } else {
            // 标识草稿
            $saveData['status'] = self::DRAFT_STATUS;
        }
        Db::table('article')->where(['id' => $id])->update($saveData);
        // 文章标签
        $newTags = $oldTagIds = [];
        if (isset($input['tags']) && !empty($input['tags'])) {
            $newTags = $input['tags'];
        }

        $articleTagLists = Db::table('article_tags')->selects(['tag_id'])->where(['article_id' => $id])->get();
        if (!empty($articleTagLists)) {
            $oldTagIds = array_column($articleTagLists, 'tag_id');
        }
        // 比较两次tag是否有不同，相同不做处理，不同直接删除所有标签，重新生成
        if (!empty(array_diff($newTags, $oldTagIds))) {
            Db::table('article_tags')->where(['article_id' => $id])->delete();
            $tagSaveData = [];
            foreach ($newTags as $tag) {
                $tagSaveData[] = [
                    'article_id' => $id,
                    'tag_id'     => $tag,
                ];
            }
            Db::table('article_tags')->insertMulti($tagSaveData);
        }

        return ['message' => ['common', '3001']];
    }

    /**
     * 增删改查验证
     * @param  array $data 凭据
     * @return boolean | array
     */
    public function validate($data)
    {
        return true;
    }
}
