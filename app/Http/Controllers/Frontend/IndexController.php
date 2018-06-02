<?php
namespace App\Http\Controllers\Frontend;

use Ububs\Core\Component\Db\Db;
use App\Repositories\Frontend\ArticleRepository;

class IndexController extends CommonController
{
    public function __construct()
    {
        
    }

    public function articles()
    {
        $input  = Request::get();
        $result = ArticleRepository::getInstance()->lists($input);
        return $this->response($result);
    }

    public function articleDetail($id)
    {
        $list = Db::table('article')->where('id', $id)->first();
        $this->assign('list', $list);
        $this->display();
    }
}