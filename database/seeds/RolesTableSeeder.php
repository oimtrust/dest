<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('roles')->insert([
            [
                'name'          => 'Admin',
                'slug'          => 'admin',
                'description'   => 'Admin merupakan user yang memiliki hak akses penuh kedalam aplikasi',
                'created_by'    => 1,
            ],
            [
                'name'          => 'Project Manager',
                'slug'          => 'project-manager',
                'description'   => 'Project Manager adalah user yang dapat membuat project dan memonitor progress testing',
                'created_by'    => 1,
            ],
            [
                'name'          => 'Quality Assurance',
                'slug'          => 'quality-assurance',
                'description'   => 'Quality Assurance adalah user yang membuat user story, scenario test, dan yang memberikan issue ke dev.',
                'created_by'    => 1,
            ],
            [
                'name'          => 'Developer',
                'slug'          => 'developer',
                'description'   => 'Developer adalah user yang menyelesaikan task yang diberikan oleh quality assurance',
                'created_by'    => 1,
            ]
        ]);
    }
}
