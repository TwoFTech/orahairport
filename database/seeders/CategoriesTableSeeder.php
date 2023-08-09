<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            [
                'label'=> "Adulte(12+)",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'label'=> "Enfant(2-12)",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            
            [
                'label'=> "Bébé(0-2)",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ]);
    }
}
