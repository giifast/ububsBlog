<?php
namespace App\Http\Controllers\Backend;

use Ububs\Core\Component\Db\Db;
use App\Repositories\Backend\WebsiteRepository;

class WebsiteController extends CommonController
{
    public function __construct()
    {
        
    }

    public function showSetting()
    {
        $result = WebsiteRepository::getInstance()->showSetting();
        return $this->response($result);
    }

    public function saveSetting()
    {
        $input = $this->request('post');
        $result = WebsiteRepository::getInstance()->saveSetting($input);
        return $this->response($result);
    }

    public function test()
    {
        
    }
}



