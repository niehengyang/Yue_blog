<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id')->comment('唯一自增id');
            $table->integer('article_id')->comment('文章id');
            $table->string('article_title',100)->comment('文章标题');
            $table->integer('parent_id')->comment('父节点id');
            $table->integer('user_id')->comment('评论者id');
            $table->boolean('release_size')->comment('评论状态');
            $table->text('comment_content')->comment('评论内容');
            $table->string('nickname',50)->comment('评论者昵称');
            $table->string('email',100)->unique()->comment('客户邮箱');
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
        Schema::dropIfExists('comments');
    }
}
