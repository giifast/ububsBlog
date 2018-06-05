<?php
namespace App\Http\Controllers\Frontend;

use Ububs\Core\Component\Db\Db;
use App\Repositories\Frontend\IndexRepository;

class IndexController extends CommonController
{
    public function __construct()
    {
        
    }

    public function about()
    {
        $result = IndexRepository::getInstance()->about();
        return $this->response($result);
    }
}