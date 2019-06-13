<?php

use Illuminate\Database\Seeder;

class ConditionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('conditions')->insert([
            'story_id'          => 1,
            'pre_condition'     => 'user inserting email and password',
            'post_condition'    => 'user logged in dest app',
            'status'            => 'mandatory',
            'created_by'        => 1
        ]);
    }
}
