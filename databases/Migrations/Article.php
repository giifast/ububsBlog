<?php
namespace Databases\Migrations;

use Ububs\Core\Component\Db\Schema;
use Ububs\Core\Component\Db\Migrations\Migration;

class Article extends Migration
{

    public function run()
    {
        $table = 'article';
        if (!Schema::isExist($table)) {
            Schema::create($table, function ($table) {
                $table->engine = 'InnoDB';
                $table->increments('id');
                $table->tinyInteger('category_menu_id', 4)->unsigned()->default(0)->comment('菜单id');
                $table->integer('creator')->unsigned()->default(0)->comment('创建人');
                $table->string('title', 50)->default('')->comment('标题');
                $table->string('author', 20)->default('')->comment('作者');
                $table->string('thumbnail', 255)->default('')->comment('缩略图');
                $table->text('content')->nullable()->comment('内容');
                $table->tinyInteger('reprinted')->unsigned()->default(0)->comment('是否转载0|1');
                $table->tinyInteger('status')->unsigned()->default(0)->comment('状态dict');
                $table->integer('created_at', 10)->unsigned()->default(0)->comment('创建时间');
                $table->integer('deleted_at', 10)->unsigned()->default(0)->comment('加入回收站时间');
                // 索引
                $table->index('creator', 'index_creator');
                $table->index('author', 'index_author');
            });
        }
    }
}
