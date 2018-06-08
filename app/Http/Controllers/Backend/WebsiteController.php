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

    public function dumpDatabase($name)
    {
        $result = WebsiteRepository::getInstance()->dumpDatabase($name);
        return $this->response($result);
    }

    public function dumpIndex()
    {
        $input = $this->request('get');
        $result = WebsiteRepository::getInstance()->dumpLists($input);
        return $this->response($result);
    }

    public function dumpLists()
    {
        $input = $this->request('get');
        $result = WebsiteRepository::getInstance()->dumpLists($input);
        return $this->response($result);
    }

    public function deleteDump($ids)
    {
        $result = WebsiteRepository::getInstance()->deleteDump($ids);
        return $this->response($result);
    }
}



