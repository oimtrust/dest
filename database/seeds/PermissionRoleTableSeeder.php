<?php

use Illuminate\Database\Seeder;

class PermissionRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permission_role')->insert(array(
            0 =>
            array (
                'role_id'       => '1',
                'permission_id' => '1',
                'operation'     => '["show", "create", "edit", "destroy", "restore", "delete-permanent"]',
            ),
            1 =>
            array (
                'role_id'       => '1',
                'permission_id' => '2',
                'operation'     => '["show", "create", "edit", "destroy", "restore", "delete-permanent"]',
            ),
            2 =>
            array (
                'role_id'       => '1',
                'permission_id' => '3',
                'operation'     => '["show", "create", "edit", "destroy", "restore", "delete-permanent"]',
            ),
            3 =>
            array (
                'role_id'       => '1',
                'permission_id' => '4',
                'operation'     => '["show", "create", "edit", "destroy", "restore", "delete-permanent"]',
            ),
            4 =>
            array (
                'role_id'       => '1',
                'permission_id' => '5',
                'operation'     => '["show", "create", "edit", "destroy", "restore", "delete-permanent"]',
            ),
        ));
    }
}
