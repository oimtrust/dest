<?php

use Illuminate\Database\Seeder;

class TestcasesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('testcases')->insert([
            'scenario_id'       => 1,
            'expected_result'   => 'User can be logged in',
            'description'       => '<b>None</b>',
            'status'            => 'Testing',
            'created_by'        => 1
        ]);
    }
}
