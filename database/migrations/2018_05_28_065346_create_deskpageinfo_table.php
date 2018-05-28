<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeskpageinfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deskpageinfo', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('web_release_size')->comment('网站状态');
            $table->string('web_title',30)->comment('网站标题');
            $table->string('web_speak',60)->comment('网站副标题');
            $table->string('web_describe',120)->comment('网站描述');
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
        Schema::dropIfExists('deskpageinfo');
    }
}
