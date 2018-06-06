<?php
namespace Databases\Seeds;

use Ububs\Core\Component\Db\Db;
use Ububs\Core\Component\Db\Seeds\Seed;

class Admin extends Seed
{
    public function run()
    {
        Db::table('admin')->truncate();
        $data   = [];
        $data[] = [
            'role_id'         => 1,
            'account'        => 'admin',
            'password'        => generatePassword('123123'),
            'mail'            => 'linlm1994@gmail.com',
            'face'            => sha1(1) . '.png',
            'last_login_ip'   => '192.168.102.143',
            'last_login_time' => time(),
            'created_at'      => time(),
            'status'          => 1,
        ];
        for ($i = 0; $i < 100; $i++) {
            $data[] = [
                'role_id'         => $i % 5,
                'account'        => '林联敏' . $i,
                'password'        => generatePassword('123123'),
                'mail'            => 'linlm' . $i . '@gmail.com',
                'face'            => sha1($i) . '.png',
                'last_login_ip'   => '192.168.102.143',
                'last_login_time' => time(),
                'created_at'      => time(),
                'status'          => 1,
            ];
        }
        Db::table('admin')->insert($data);
    }
}
