<?php
namespace Databases\Migrations;

use Ububs\Core\Component\Db\Schema;
use Ububs\Core\Component\Db\Migrations\Migration;

class CategoryMenu extends Migration
{

    public function run()
    {
        $table = 'category_menu';
        if (!Schema::isExist($table)) {
            Schema::create($table, function ($table) {
                $table->engine = 'InnoDB';
                $table->increments('id');
                $table->tinyInteger('dict_category')->unsigned()->default(0)->comment('菜单类型');
                $table->string('name', 20)->comment('菜单名称');        
            });
        }
    }
}
