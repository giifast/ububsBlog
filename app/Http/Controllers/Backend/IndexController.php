<?php
namespace App\Http\Controllers\Backend;

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
