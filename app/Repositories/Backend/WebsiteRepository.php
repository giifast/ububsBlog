<?php
namespace App\Repositories\Backend;

use Ububs\Core\Component\Db\Db;

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
        $result = Db::table('website_config')->where(['id' => 1])->update([
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
}
