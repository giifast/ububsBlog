<?php
namespace Databases\Migrations;

use Ububs\Core\Component\Db\Migrations\Migration;
use Ububs\Core\Component\Db\Schema;

class Role extends Migration
{

    public function run()
    {
        $table = 'role';
        if (!Schema::isExist($table)) {
            Schema::create($table, function ($table) {
                $table->engine = 'InnoDB';
                $table->increments('id');
                $table->string('name', 20)->comment('角色名');
                $table->tinyInteger('type')->unsigned()->default(0)->comment('前台还是后台角色0|1');
                $table->tinyInteger('super_permission')->unsigned()->default(0)->comment('是否是超级管理员0|1');
                $table->text('menu_ids')->nullable()->comment('权限节点，竖线分隔');
                $table->tinyInteger('status')->unsigned()->default(1)->comment('状态(0|1)');
            });
        }
    }
}
