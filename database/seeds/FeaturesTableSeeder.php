<?php

use Illuminate\Database\Seeder;

class FeaturesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('features')->insert([
            'title'         => 'Authentication',
            'note'          => 'For login to dest app',
            'story_id'      => 1,
            'created_by'    => 1
        ]);
    }
}
