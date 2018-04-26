<?php

use Illuminate\Database\Seeder;

class AccountTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('accounts')->insert([
            'id' => 1,
            'nickname' => '古风平',
            'name' => '你猜猜',
            'username' => 'admin',
            'password' => bcrypt('123456'),
            'email' => 'NHY@163.com',
            'admin_lastloginip' => '127.0.0.1',
            'admin_lastlogintime' => '2018-04-20 20:15:16',
            'admin_status' => 1
        ]);
    }
}
