<?php
namespace Databases\Migrations;

use Ububs\Core\Component\Db\Migrations\Migration;
use Ububs\Core\Component\Db\Schema;

class WebsiteDump extends Migration
{

    public function run()
    {
        $table = 'website_dump';
        if (!Schema::isExist($table)) {
            Schema::create($table, function ($table) {
                $table->engine = 'InnoDB';
                $table->increments('id');
                $table->integer('admin_id')->default(0)->comment('操作管理员');
                $table->string('path', 255)->default('')->comment('文件路径');
                $table->integer('created_at')->default(0)->comment('导出时间');
            });
        }
    }
}
