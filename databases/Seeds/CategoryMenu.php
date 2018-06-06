<?php
namespace Databases\Seeds;

use Ububs\Core\Component\Db\Db;
use Ububs\Core\Component\Db\Seeds\Seed;

class CategoryMenu extends Seed
{
    public function run()
    {
        Db::table('category_menu')->truncate();
        $category = [10, 20];
        $data     = [
            [
                'dict_category' => $category[rand(0, 1)],
                'name'     => 'PHP后端技术',
            ],
            [
                'dict_category' => $category[rand(0, 1)],
                'name'     => 'Java后端技术',
            ],
            [
                'dict_category' => $category[rand(0, 1)],
                'name'     => '服务端技术',
            ],
            [
                'dict_category' => $category[rand(0, 1)],
                'name'     => 'nginx服务器',
            ],
            [
                'dict_category' => $category[rand(0, 1)],
                'name'     => '前端技术',
            ],
            [
                'dict_category' => $category[rand(0, 1)],
                'name'     => 'javascript',
            ],
            [
                'dict_category' => $category[rand(0, 1)],
                'name'     => 'css',
            ],
        ];
        Db::table('category_menu')->insert($data);
    }
}
