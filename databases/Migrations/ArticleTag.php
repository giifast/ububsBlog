<?php
namespace Databases\Migrations;

use Ububs\Core\Component\Db\Migrations\Migration;
use Ububs\Core\Component\Db\Schema;

class ArticleTag extends Migration
{

    public function run()
    {
        $table = 'article_tag';
        if (!Schema::isExist($table)) {
            Schema::create($table, function ($table) {
                $table->engine = 'InnoDB';
                $table->integer('article_id', 10)->unsigned()->comment('文章id');
                $table->integer('tag_id', 10)->unsigned()->comment('标签id');
                
                $table->index('article_id', 'index_article_id');
                $table->index('tag_id', 'index_tag_id');
            });
        }
    }
}
