<?php

namespace Database\Seeders;

use Aaran\Frappe\Database\Seeders\StockBalanceSeeder;
use Aaran\Frappe\Models\StockBalance;
use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        StockBalance::factory()->count(20)->create();

        $this->call([
            UserSeeder::class,
            StockBalanceSeeder::class,


        ]);
    }
}
