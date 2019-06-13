<?php

use Illuminate\Database\Seeder;

class ScenariosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('scenarios')->insert([
            'action'        => 'Login',
            'prerequisites' => 'The user must enter the email and password',
            'test_step'     => '1. user input email, 2. user input password',
            'feature_id'    => 1,
            'created_by'    => 1
        ]);
    }
}
