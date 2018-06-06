<?php
namespace Databases\Seeds;

use Ububs\Core\Component\Db\Db;
use Ububs\Core\Component\Db\Seeds\Seed;

class User extends Seed
{
    public function run()
    {
        Db::table('user')->truncate();
        $data = [];
        for ($i = 0; $i < 1000; $i++) {
            $data[] = [
                'username'        => '林联敏' . $i,
                'password'        => generatePassword('123123'),
                'mail'            => 'linlm' . $i . '@gmail.com',
                'gender'          => 10,
                'face'            => sha1($i) . '.png',
                'last_login_ip'   => '192.168.102.143',
                'last_login_time' => time(),
                'created_at'     => time(),
                'status'          => mt_rand(0, 1),
            ];
        }
        Db::table('user')->insert($data);
    }
}
