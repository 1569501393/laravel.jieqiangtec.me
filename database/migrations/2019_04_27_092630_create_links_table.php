<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('links_test', function (Blueprint $table){
            $table->engine   = 'Innodb';
            $table->comments = '// 友情链接表';
            $table->increments('link_id');
            $table->string('link_name', 100)->default('')->comment('// 名称');
            $table->string('link_title', 100)->default('')->comment('// 标题');
            $table->string('link_url')->default('')->comment('// 链接');
            $table->integer('link_order')->default(0)->comment('// 排序');
            // $table->timestamps();
             $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
             $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            // $table->timestamp('created_at')->default('0000-00-00 00:00:00');

            /*$table->timestamp('updated_at');
            $table->timestamp('created_at');*/

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('links');
    }
}
