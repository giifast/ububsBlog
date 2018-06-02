<?php
namespace App\Http\Controllers\Backend;

use Ububs\Core\Component\Db\Db;


class IndexController extends CommonController
{
    public function __construct()
    {
        
    }

    public function index()
    {
        $this->display('backend');
    }

    public function test()
    {
        
    }
}



