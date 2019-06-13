<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('stories')->insert([
            'epic'                  => 'Login',
            'user_story'            => 'User can be login with email and password',
            'acceptance_criteria'   => 'Email (mandatory, unique) and password (mandatory, min:6)',
            'data'                  => 'Email, Password',
            'note'                  => '-',
            'project_id'            => 1,
            'created_by'            => 1
        ]);
    }
}
