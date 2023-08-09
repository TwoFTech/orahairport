<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Str;

class CitiesTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cities')->insert([
            [
                'label'=> "Cotonou",
                'country_id' => 24,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'label'=> "Abomey-Calavi",
                'country_id' => 24,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'label'=> "Porto-Novo",
                'country_id' => 24,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'label'=> "Parakou",
                'country_id' => 24,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'label'=> "Djougou",
                'country_id' => 24,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'label'=> "Bohicon",
                'country_id' => 24,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'label'=> "Natitingou",
                'country_id' => 24,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'label'=> "Savè",
                'country_id' => 24,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'label'=> "Abomey",
                'country_id' => 24,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'label'=> "Nikki",
                'country_id' => 24,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'label'=> "Lokossa",
                'country_id' => 24,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'label'=> "Ouidah",
                'country_id' => 24,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'label'=> "Savalou",
                'country_id' => 24,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'label'=> "Douala",
                'country_id' => 39,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'label'=> "Yaoundé",
                'country_id' => 39,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'label'=> "Garoua",
                'country_id' => 39,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'label'=> "Bamenda",
                'country_id' => 39,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'label'=> "Maroua",
                'country_id' => 39,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'label'=> "Lomé",
                'country_id' => 223,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'label'=> "Sokodé",
                'country_id' => 223,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'label'=> "Kara",
                'country_id' => 223,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'label'=> "Kpalimé",
                'country_id' => 223,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'label'=> "Atakpamé",
                'country_id' => 223,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'label'=> "Bouaké",
                'country_id' => 55,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'label'=> "Abidjan",
                'country_id' => 55,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'label'=> "San Pédro",
                'country_id' => 55,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'label'=> "Man",
                'country_id' => 55,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'label'=> "Daloa",
                'country_id' => 55,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'label'=> "Yamoussoukro",
                'country_id' => 55,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'label'=> "Khorogo",
                'country_id' => 55,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'label'=> "Accra",
                'country_id' => 84,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'label'=> "Kumasi",
                'country_id' => 84,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'label'=> "Tamale",
                'country_id' => 84,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'label'=> "Sekondi-Takoradi",
                'country_id' => 84,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'label'=> "Ashaiman",
                'country_id' => 84,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ]);
    }
}
