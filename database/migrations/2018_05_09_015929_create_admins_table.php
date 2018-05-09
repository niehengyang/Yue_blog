<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->increments('adminid');
            $table->string('account_number',50)->comment('账号');
            $table->string('name',50)->comment('用户姓名');
            $table->string('nickname',50)->comment('用户昵称');
            $table->string('email',100)->unique()->comment('管理员邮箱');
            $table->string('password',64)->comment('管理员登录密码');
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
        Schema::dropIfExists('admins');
    }
}
