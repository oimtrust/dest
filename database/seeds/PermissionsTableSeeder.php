<?php

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            [
                'name'  => 'User',
                'slug'  => 'user'
            ],
            [
                'name'  => 'Project',
                'slug'  => 'project'
            ],
            [
                'name'  => 'My Project',
                'slug'  => 'my-project'
            ],
            [
                'name'  => 'My Issue',
                'slug'  => 'my-issue'
            ],
            [
                'name'  => 'Trash',
                'slug'  => 'trash'
            ]
        ]);
    }
}
