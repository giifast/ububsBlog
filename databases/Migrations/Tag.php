<?php
namespace Databases\Migrations;

use Ububs\Core\Component\Db\Migrations\Migration;
use Ububs\Core\Component\Db\Schema;

class Tag extends Migration
{

    public function run()
    {
        $table = 'tag';
        if (!Schema::isExist($table)) {
            Schema::create($table, function ($table) {
                $table->engine = 'InnoDB';
                $table->increments('id');
                $table->tinyInteger('type')->unsigned()->default(0)->comment('标签类型dict');
                $table->string('name', 20)->comment('标签名');
                $table->integer('creator', 10)->unsigned()->default(0)->comment('创建人id,0表示公共标签');
            });
        }
    }
}
