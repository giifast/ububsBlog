<?php
namespace App\Repositories\Frontend;

use App\Service\ApiService;
use Ububs\Core\Component\Db\Db;

class LeaveRepository extends CommonRepository
{
    // 正常
    const COMMON_STATUS = 10;

    /**
     * 获取列表
     * @param  array $input
     * @return array
     */
    public function lists($input)
    {
        $pagination = isset($input['pagination']) ? $input['pagination'] : [];
        $dbInstance = Db::table('leave_message')->selects(['id', 'mail', 'content', 'address', 'ip_address', 'created_at'])->orderBy('id', 'desc');
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
        $result = Db::table('leave_message')->selects(['title', 'content', 'category_menu_id', 'author', 'creator', 'thumbnail', 'created_at', 'reprinted', 'status'])->where('id', $id)->first();
        // 获取标签
        if (empty($result)) {
            return ['code' => ['leave_message', '4001']];
        }
        $result['user'] = Db::table('admin')->selects(['id', 'account'])->where('id', $result['creator'])->first();

        // 文章关联tag标签
        $result['tags'] = [];
        $leaveTagLists  = Db::table('leave_tag')->selects(['tag_id'])->where('leave_id', $id)->get();
        if (empty($leaveTagLists)) {
            return ['list' => $result];
        }
        $tagLists = Db::table('tag')->selects(['id'])->whereIn('id', array_column($leaveTagLists, 'tag_id'))->get();
        if (empty($tagLists)) {
            return ['list' => $result];
        }
        $result['tags'] = array_column($tagLists, 'id');
        return ['list' => $result];
    }

    public function store($input)
    {
        if (!$data = $this->validate($input)) {
            return ['code' => ['common', '1003']];
        }
        $result = Db::table('leave_message')->create($data);
        if (!$result) {
            return ['code' => ['leave', '4001']];
        }
        $data['created_at'] = date('d M Y', $data['created_at']);
        return [
            'data'    => $data,
            'message' => ['leave', '1001'],
        ];
    }

    private function validate($input)
    {
        $content = isset($input['content']) ? $input['content'] : '';
        $mail    = isset($input['mail']) ? $input['mail'] : '';
        if (!$content) {
            return false;
        }
        $ip = getRealIp();
        return [
            'mail'       => addslashes($mail),
            'content'    => addslashes($content),
            'ip_address' => $ip,
            'address'    => ApiService::getAddressByIp($ip),
            'created_at' => time(),
        ];
    }
}
