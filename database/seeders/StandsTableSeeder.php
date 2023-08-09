<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use Illuminate\Support\Str;

class StandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('stands')->insert([
            [
                'name'=> "tonysarl",
                'status'=> true,
                'phone'=> "68691850",
                'city_id' => 1,
                'quartier' => 'zoundja',
                'rue' => 'rue 451',
                'indication' => 'Carréfour arcon ville',
                'id_transfert' => 100007784547,
                'code' => bcrypt('tonysarl@10$'),
                'token' => Str::uuid(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ]);
    }
}
