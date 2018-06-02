<?php
namespace App\Http\Controllers\Frontend;

use Ububs\Core\Component\Db\Db;


class IndexController extends CommonController
{
    public function __construct()
    {
        
    }

    public function index()
    {
    	$this->assign('a', 'Linlianmin');
        $this->display();
    }

    public function test()
    {
        // $result = DB::taskQuery("show tables");
        // $result = Db::table('user')->where(['gender' => 10])->where('username', 'like', '%测试%')->whereIn('id', [1, 2, 3, 4, 5])->whereBetween('id', [1, 4])->whereNotIn('id', [10, 20, 1])->whereNotBetween('id', [5, 10])->get();
        // $result = Db::table('user')->where('id', 'in', [1, 10])->delete();
        // $result = Db::table('user')->insert([
        //     [
        //     'face' => 'aaaa',
        //     'gender' => 11,
        //     'username' => 'test',
        //     'password' => sha1('gggg'),
        //     'mail' => '292034@qq.com'
        // ],
        // [
        //     'face' => 'aaaa',
        //     'gender' => 11,
        //     'username' => 'test',
        //     'password' => sha1('gggg'),
        //     'mail' => '292034@qq.com'
        // ]
        // ]);
        $result = Db::table('user')->whereIn('id', [88, 100, 101])->whereNotBetween('id', [88, 99])->get();
        // $result = Db::table('user')->get();
        // $result = getServ()->taskwait("show tables;");
    	return write_response($result);
    }
}



