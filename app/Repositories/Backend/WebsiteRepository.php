<?php
namespace App\Repositories\Backend;

use App\Service\DbService;
use Ububs\Core\Component\Auth\Auth;
use Ububs\Core\Component\Db\Db;
use Ububs\Core\Swoole\Task\TaskManager;

class WebsiteRepository extends CommonRepository
{
    public function showSetting()
    {
        $result['list'] = Db::table('website_config')->find(1);
        return $result;
    }

    public function saveSetting($input)
    {
        $title       = isset($input['title']) ? $input['title'] : '';
        $author      = isset($input['author']) ? $input['author'] : '';
        $thumbnail   = isset($input['thumbnail']) ? $input['thumbnail'] : '';
        $description = isset($input['description']) ? implode(',', $input['description']) : '';
        $about       = isset($input['about']) ? $input['about'] : '';
        $copyright   = isset($input['copyright']) ? $input['copyright'] : '';
        $result      = Db::table('website_config')->where(['id' => 1])->update([
            'title'       => $title,
            'author'      => $author,
            'thumbnail'   => $thumbnail,
            'description' => $description,
            'about'       => $about,
            'copyright'   => $copyright,
        ]);
        if (!$result) {
            return ['code' => ['common', '3002']];
        }
        return ['message' => ['common', '3001']];
    }

    public function dumpDatabase($name)
    {
        $input = [
            'name'     => $name,
            'admin_id' => Auth::guard('admin')->id(),
        ];
        $result = TaskManager::getInstance()->task($input, function (\swoole_server $serv, $task_id, $data) {
            $path = DbService::getInstance()->dumpDatabase($data['name']);
            Db::table('website_dump')->create([
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
}
