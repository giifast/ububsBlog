<?php
namespace App\Http\Controllers\Backend;

use App\Repositories\Backend\ArticleRepository;
use App\Repositories\Common\DictRepository;
use Ububs\Core\Http\Interaction\Request;

class ArticleController extends CommonController
{

    // 列表页面
    public function index()
    {
        $input  = Request::get();
        $result = ArticleRepository::getInstance()->lists($input);
        $articleOptions    = ArticleRepository::getInstance()->options();
        $dictOptions       = DictRepository::getInstance()->options(['article_status']);
        $result['options'] = array_merge($articleOptions, $dictOptions);
        return $this->response($result);
    }

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

    // 新增
    public function store()
    {
        $input  = Request::post();
        $result = ArticleRepository::getInstance()->store($input);
        unset($input['content']);
        return $this->response($result, [
            'type' => 'log',
            'data' => [
                'type'   => 'store',
                'params' => $input,
            ],
        ]);
    }

    // 加入回收站
    public function recycle($ids)
    {
        $result = ArticleRepository::getInstance()->recycle($ids);
        return $this->response($result, [
            'type' => 'log',
            'data' => [
                'type'   => 'update',
                'params' => ['id' => $ids],
            ],
        ]);
    }

    // 删除
    public function delete($ids)
    {
        $result = ArticleRepository::getInstance()->delete($ids);
        return $this->response($result, [
            'type' => 'log',
            'data' => [
                'type'   => 'delete',
                'params' => ['id' => $ids],
            ],
        ]);
    }

    // 编辑
    public function update($id)
    {
        $input  = Request::post();
        $result = ArticleRepository::getInstance()->update($id, $input);
        unset($input['content']);
        return $this->response($result, [
            'type' => 'log',
            'data' => [
                'type'   => 'update',
                'params' => $input,
            ],
        ]);
    }

    // 详情
    public function detail($id)
    {
        $result = ArticleRepository::getInstance()->detail($id);
        $articleOptions    = ArticleRepository::getInstance()->options();
        $dictOptions       = DictRepository::getInstance()->options(['article_status', 'category']);
        $result['options'] = array_merge($articleOptions, $dictOptions);
        return $this->response($result);
    }
}
