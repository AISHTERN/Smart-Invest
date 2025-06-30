<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserInvestmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        \DB::table('user_investments')->insert([
            ['user_id' => 2, 'investment_id' => 1],
            ['user_id' => 3, 'investment_id' => 1],
            ['user_id' => 4, 'investment_id' => 2],
        ]);
    }

}
