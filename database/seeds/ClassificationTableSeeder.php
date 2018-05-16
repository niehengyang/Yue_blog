<?php

use Illuminate\Database\Seeder;

class ClassificationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory('App\Model\classification',3)->create([
            'password' => bcrypt('123456')
        ]);
    }
}
