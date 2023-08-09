<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CabinsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cabins')->insert([
            [
                'label'=> "Eco",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'label'=> "Business",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'label'=> "First",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'label'=> "Premium",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ]);
    }
}
