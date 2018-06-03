<?php
namespace App\Http\Controllers\Frontend;

use App\Repositories\Frontend\ArticleRepository;
use App\Repositories\Common\DictRepository;
use Ububs\Core\Http\Interaction\Request;

class ArticleController extends CommonController
{

    // 列表
    public function lists()
    {
        $input  = Request::get();
        $result = ArticleRepository::getInstance()->lists($input);
        return $this->response($result);
    }

    public function show($id)
    {
        $result = ArticleRepository::getInstance()->show($id);
        return $this->response($result);
    }
}
