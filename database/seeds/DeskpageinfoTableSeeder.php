<?php

use Illuminate\Database\Seeder;

class DeskpageinfoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('deskpageinfo')->insert([
            'id' => 1,
            'web_release_size' => 1,
            'web_title' => 'Yue_blog',
            'web_speak' => 'HELLO I AM NHY',
            'web_describe' => 'Yue_blog是一个基于laravel5开发的博客系统'
        ]);
    }
}
