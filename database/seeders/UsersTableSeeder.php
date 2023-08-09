<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Str;

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
            [
                'name'=> "Forester A. CODJO",
                'email'=> "foranster04@gmail.com",
                'phone'=> "0022962691850",
                'email_verified_at' => true,
                'status' => true,
                'password' => bcrypt('Dev1@2FT'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name'=> "Fabrice DEGLA",
                'email'=> "fabiodegla15@gmail.com",
                'phone'=> "0022967012331",
                'email_verified_at' => true,
                'status' => true,
                'password' => bcrypt('Dev2@2FT'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'name'=> "Stéphane AWORE",
                'email'=> "ceo@travel-orahairport.com",
                'phone'=> "+22969259425",
                'email_verified_at' => true,
                'status' => true,
                'password' => bcrypt('Ceo@2022'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            // [
            //     'name'=> "Bernard HOUANDOSSI",
            //     'email'=> "account@travel-orahairport.com",
            //     'phone'=> "+22995906514",
            //     'email_verified_at' => true,
            //     'status' => true,
            //     'password' => bcrypt('Account@2022'),
            //     'created_at' => Carbon::now(),
            //     'updated_at' => Carbon::now()
            // ],

            // [
            //     'name'=> "Florence N'DAMA",
            //     'email'=> "resa@travel-orahairport.com",
            //     'phone'=> "+33784074535",
            //     'email_verified_at' => true,
            //     'status' => true,
            //     'password' => bcrypt('Resa@2022'),
            //     'created_at' => Carbon::now(),
            //     'updated_at' => Carbon::now()
            // ],

            // [
            //     'name'=> "Fabrice AKPOVI",
            //     'email'=> "fabiodegla7@gmail.com",
            //     'phone'=> "+22596314694",
            //     'email_verified_at' => true,
            //     'status' => true,
            //     'password' => bcrypt('Admin@2022'),
            //     'created_at' => Carbon::now(),
            //     'updated_at' => Carbon::now()
            // ],

            // [
            //     'name'=> "Fabrice Yao AKPOVI",
            //     'email'=> "fabiodegla05@gmail.com",
            //     'phone'=> "+22555437996",
            //     'email_verified_at' => true,
            //     'status' => true,
            //     'password' => bcrypt('Merchant@22'),
            //     'created_at' => Carbon::now(),
            //     'updated_at' => Carbon::now()
            // ],
        ]);
    }
}
