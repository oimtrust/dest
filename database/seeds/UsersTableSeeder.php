<?php

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'      => 'Admin',
            'email'     => 'admin@gmail.com',
            'password'  => Hash::make('rahasia'),
            'phone'     => '089898989898',
            'roles'     => json_encode(['ADMIN', 'PM', 'DEV', 'QA']),
            'address'   => 'Malang, Jawa Timur',
            'status'    => 'ACTIVE',
            'created_by' => 1
        ]);

        $users  = [];
        $faker  = Factory::create();
        for ($i=0; $i < 10; $i++) {
            $users[$i] = [
                'name'      => $faker->name,
                'email'     => $faker->unique()->freeEmail,
                'password'  => Hash::make('rahasia'),
                'phone'     => $faker->tollFreePhoneNumber,
                'roles'     => json_encode(['PM', 'DEV', 'QA']),
                'address'   => $faker->address,
                'status'    => rand(0, 1) ? 'ACTIVE' : 'INACTIVE',
                'created_by' => 1
            ];
        }
        DB::table('users')->insert($users);
    }
}
