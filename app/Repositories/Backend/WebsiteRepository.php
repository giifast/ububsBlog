<?php
namespace App\Repositories\Backend;

use Ububs\Core\Component\Db\Db;

class WebsiteRepository extends CommonRepository
{
    public function showSetting()
    {
    	$result['list'] = [];
    	return $result;
    }

    public function saveSetting($input)
    {
    	return [];
    }
}