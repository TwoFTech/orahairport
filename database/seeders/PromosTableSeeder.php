<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class PromosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('promos')->insert([
            [
                'name'=> "Promotion de lancement",
                'code'=> Str::random(8),
                'percentage'=> 100,
                'begin'=> "2022-11-19",
                'end'=> "2022-11-26",
                'status'=> "Actif",
                'token'=> Str::uuid(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ]);
    }
}
