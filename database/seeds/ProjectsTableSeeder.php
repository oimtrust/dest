<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('projects')->insert([
            'title'         => 'Dest App',
            'slug'          => 'dest-app',
            'description'   => 'Monitor and documentation for QA Engineer in manual test',
            'owner'         => 'Fathur Rohim',
            'status'        => 'PUBLISH',
            'created_by'    => 1,
        ]);

        DB::table('project_user')->insert([
            'project_id'    => 1,
            'user_id'       => 1
        ]);
    }
}
