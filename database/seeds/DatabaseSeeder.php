<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RolesTableSeeder::class,
            UsersTableSeeder::class,
            ProjectsTableSeeder::class,
            StoriesTableSeeder::class,
            ConditionsTableSeeder::class,
            FeaturesTableSeeder::class,
            ScenariosTableSeeder::class,
            TestcasesTableSeeder::class,
            IssuesTableSeeder::class
        ]);
    }
}
