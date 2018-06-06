<?php
namespace Databases\Migrations;

use Ububs\Core\Component\Db\Migrations\Migration;
use Ububs\Core\Component\Db\Schema;

class WebsiteConfig extends Migration
{

    public function run()
    {
        $table = 'website_config';
        if (!Schema::isExist($table)) {
            Schema::create($table, function ($table) {
                $table->engine = 'InnoDB';
                $table->increments('id');
                $table->string('title', 30)->default('')->comment('名称');
                $table->string('author', 30)->default('')->comment('作者');
                $table->string('description', 255)->default('')->comment('关键字');
                $table->text('about')->nullable()->comment('关于');
                $table->string('thumbnail', 255)->default('')->comment('缩略图');
                $table->string('copyright', 255)->default('')->comment('版权');
            });
        }
    }
}
