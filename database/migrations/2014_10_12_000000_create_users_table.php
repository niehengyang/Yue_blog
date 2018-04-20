<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',50)->comment('用户昵称');
            $table->string('email',100)->unique()->comment('管理员邮箱');
            $table->string('password',120)->comment('管理员登录密码');
            $table->ipAddress('admin_lastloginip')->nullable()->comment('最后登录ip');
            $table->timestamp('admin_lastlogintime')->nullable()->comment('最后登录时间');
            $table->char('admin_status',1)->default(1)->comment('管理员状态,0:禁用,1:正常');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
