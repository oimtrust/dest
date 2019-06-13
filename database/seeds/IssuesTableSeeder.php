<?php

use Illuminate\Database\Seeder;

class IssuesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('issues')->insert([
            'testcase_id'       => 1,
            'type'              => 'Functional',
            'severity'          => 'Minor',
            'priority'          => 'Medium',
            'assigned_to'       => 1,
            'title'             => 'Cannot Delete User Story',
            'description'       => 'When I open the user story and choose one of the wrong data to be deleted suddenly I get an error in the action to delete',
            'status'            => 'OPEN',
            'created_by'        => 1,
        ]);
    }
}
