<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            CompaniesTablesSeeder::class,
            SettingsTableSeeder::class,
            CabinsTableSeeder::class,
            CountriesTablesSeeder::class,
            UsersTableSeeder::class,
            CategoriesTableSeeder::class,
            PromosTableSeeder::class,
            CitiesTablesSeeder::class,
            // StandsTableSeeder::class,
            // UserStandsTableSeeder::class,
            RolesAndPermissionsSeeder::class,
        ]);
    }
}
