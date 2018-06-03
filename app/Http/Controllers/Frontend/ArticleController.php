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

    // 获取 options
    public function options()
    {
        $articleOptions    = ArticleRepository::getInstance()->options();
        $dictOptions       = DictRepository::getInstance()->options(['article_status', 'category']);
        $result['options'] = array_merge($articleOptions, $dictOptions);
        return $this->response($result);
    }

    public function show($id)
    {
        $result = ArticleRepository::getInstance()->show($id);
        return $this->response($result);
    }
}
