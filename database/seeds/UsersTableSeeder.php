<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Domain\UserManagement\Entities\User;
use App\Domain\UserManagement\Entities\Role;

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
            'address'   => 'Malang, Jawa Timur',
            'status'    => 'ACTIVE',
            'created_by' => 1
        ]);

        User::find(1)->roles()->attach(Role::findBySlug('admin')->id);

        factory(User::class, 50)->create()->each(function ($user) {
            $user->roles()->attach(Role::inRandomOrder()->first()->id);
        });
    }
}
