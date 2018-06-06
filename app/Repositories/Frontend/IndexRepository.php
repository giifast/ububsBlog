<?php
namespace App\Repositories\Frontend;

use Ububs\Core\Component\Db\Db;

class IndexRepository extends CommonRepository
{
	/**
	 * 获取关于页面内容
	 * @return [type] [description]
	 */
	public function about()
	{
		$result['list'] = Db::table('website_config')->find(1);
		return $result;
	}
}
