<?php

namespace Database\Seeders;

use Aaran\Frappe\Database\Seeders\StockBalanceSeeder;
use Aaran\Frappe\Models\StockBalance;
use Aaran\Slider\Database\Seeders\SliderQuoteSeeder;
use Aaran\Slider\Database\Seeders\SliderSeeder;
use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            StockBalanceSeeder::class,
            SliderSeeder::class,
            SliderQuoteSeeder::class,
        ]);
    }
}
