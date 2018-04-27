<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles',function (Blueprint $table){
           $table->increments('id');
           $table->string('slug')->nullable()->unique();
           $table->string('author',50)->comment('作者');
           $table->string('title',50)->nullable()->comment('文章标题');
           $table->longText('content')->nullable()->comment('文章内容');
           $table->string('classification',50)->nullable()->comment('文章分类');
           $table->boolean('release_size')->comment('文章状态');
           $table->text('abstract')->comment('文章摘要');
           $table->string('img')->nullable()->comment('文章图片');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
