<?php
namespace Databases\Seeds;

use Ububs\Core\Component\Db\Db;
use Ububs\Core\Component\Db\Seeds\Seed;

class Tag extends Seed
{
    public function run()
    {
        Db::table('tag')->truncate();
        $data = [
            [
                'name' => 'PHP后端技术',
            ],
            [
                'name' => 'Java后端技术',
            ],
            [
                'name' => '服务端技术',
            ],
            [
                'name' => 'nginx服务器',
            ],
            [
                'name' => '前端技术',
            ],
            [
                'name' => 'javascript',
            ],
            [
                'name' => 'css',
            ],
        ];
        DB::table('tag')->insert($data);
    }
}
