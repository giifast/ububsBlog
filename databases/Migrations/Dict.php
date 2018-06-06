<?php
namespace Databases\Migrations;

use Ububs\Core\Component\Db\Migrations\Migration;
use Ububs\Core\Component\Db\Schema;

class Dict extends Migration
{

    public function run()
    {
        $table = 'dict';
        if (!Schema::isExist($table)) {
            Schema::create($table, function ($table) {
                $table->engine = 'InnoDB';
                $table->increments('id');
                $table->string('code', 30)->comment('分类代码');
                $table->string('code_name', 30)->comment('分类名称');
                $table->tinyInteger('value', 4)->unsigned()->comment('字典数值');
                $table->string('text_en', 30)->default('')->comment('字典英文文字');
                $table->string('text', 30)->default('')->comment('字典中文文字');
                $table->string('remarks', 30)->default('')->comment('备注');
                $table->tinyInteger('status')->unsigned()->default(1)->comment('状态(0|1)');
            });
        }
    }
}
