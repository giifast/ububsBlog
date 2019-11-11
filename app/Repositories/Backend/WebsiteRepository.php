<?php
namespace App\Repositories\Backend;

use App\Service\DbService;
use Ububs\Core\Component\Auth\Auth;
use Ububs\Core\Component\Db\Db;
use Ububs\Core\Http\Interaction\Response;
use Ububs\Core\Swoole\Task\TaskManager;

class WebsiteRepository extends CommonRepository
{

    public $table  = 'website_dump';
    public $fields = ['id', 'title', 'path', 'admin_id', 'created_at'];

    public function showSetting()
    {
        $result['list'] = Db::table('website_config')->find(1);
        return $result;
    }

    public function saveSetting($input)
    {
        if (!$data = $this->validate($input)) {
            return ['code' => ['common', '3003']];
        }
        $result = Db::table('website_config')->where(['id' => 1])->update($data);
        return ['message' => ['common', '3001']];
    }

    public function dumpDatabase($name)
    {
        $input = [
            'title'    => $name . date('YmdHis'),
            'name'     => $name,
            'admin_id' => Auth::getInstance('admin')->id(),
        ];
        $result = TaskManager::getInstance()->task($input, function (\swoole_server $serv, $task_id, $data) {
            $path = DbService::getInstance()->dumpDatabase($data['name']);
            $this->getDB()->create([
                'title'      => $data['title'],
                'admin_id'   => $data['admin_id'],
                'path'       => $path,
                'created_at' => time(),
            ]);
        });
        if (!$result && $result !== 0) {
            return ['code' => ['common', '3002']];
        }
        return ['message' => ['website', '0001']];
    }

    /**
     * 获取列表
     * @param  array $input
     * @return array
     */
    public function dumpLists($input)
    {
        list($fields, $pages, $wheres) = $this->parseParams($input);
        $result['lists']               = $this->getDB()->selects($fields)->where($wheres)->pagination($pages)->get();
        $result['total']               = $this->getDB()->where($wheres)->count();
        return $result;
    }

    public function dumpDownload($id)
    {
        $data = $this->getDB()->selects(['title', 'path'])->find($id);
        if (empty($data)) {
            return ['code' => ['file', '1002']];
        }
        return Response::download(APP_ROOT . $data['path'], $data['title'] . '.sql');
    }

    /**
     * 删除一条或多条数据
     * @param  string $ids 待处理的数据id
     * @return array
     */
    public function deleteDump($ids)
    {
        $idArr = explode(',', $ids);
        if (!empty($idArr)) {
            $runIds = [];
            foreach ($idArr as $id) {
                if ($id && !in_array($id, $runIds)) {
                    $runIds[] = $id;
                }
            }
            $this->getDB()->whereIn('id', $runIds)->delete();
        }
        return [
            'message' => ['common', '2001'],
        ];
    }

    public function validate($input)
    {
        $title       = isset($input['title']) ? $input['title'] : '';
        $author      = isset($input['author']) ? $input['author'] : '';
        $thumbnail   = isset($input['thumbnail']) ? $input['thumbnail'] : '';
        $description = isset($input['description']) ? implode(',', $input['description']) : '';
        $about       = isset($input['about']) ? $input['about'] : '';
        $copyright   = isset($input['copyright']) ? $input['copyright'] : '';
        return [
            'title'       => $title,
            'author'      => $author,
            'thumbnail'   => $thumbnail,
            'description' => $description,
            'about'       => $about,
            'copyright'   => $copyright,
        ];
    }
}
