<?php
namespace Databases\Seeds;

use Ububs\Core\Component\Db\Db;
use Ububs\Core\Component\Db\Seeds\Seed;

class Role extends Seed
{
    public function run()
    {
        Db::table('role')->truncate();
        $data = [
            [
                'type'             => 10,
                'name'             => '超级管理员',
                'super_permission' => 1,
                'menu_ids'         => '',
            ],
            [
                'type'             => [10, 20][rand(0, 1)],
                'name'             => '普通管理员1',
                'super_permission' => 0,
                'menu_ids'         => '1,2,3,4,5,6,7',
            ],
            [
                'type'             => [10, 20][rand(0, 1)],
                'name'             => '普通管理员2',
                'super_permission' => 0,
                'menu_ids'         => '1,2,3,4,5,6,7,8,77,22,33,44,35,567',
            ],
            [
                'type'             => [10, 20][rand(0, 1)],
                'name'             => '普通管理员3',
                'super_permission' => 0,
                'menu_ids'         => '1,2,3,4,5,6,7,8,77,22,33,44,35,567',
            ],
            [
                'type'             => [10, 20][rand(0, 1)],
                'name'             => '普通管理员4',
                'super_permission' => 0,
                'menu_ids'         => '1,2,3,4,5,6,7,8,77,22,33,44,35,567',
            ],
            [
                'type'             => [10, 20][rand(0, 1)],
                'name'             => '普通管理员5',
                'super_permission' => 0,
                'menu_ids'         => '1,2,3,4,5,6,7,8,77,22,33,44,35,567',
            ],
        ];
        Db::table('role')->insert($data);
    }
}
