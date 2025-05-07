<?php

namespace Database\Seeders;

use Aaran\Frappe\Database\Seeders\InventorySeeder;
use Aaran\Frappe\Models\Inventory;
use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        Inventory::factory()->count(20)->create();

        $this->call([
            UserSeeder::class,
            InventorySeeder::class,


        ]);
    }
}
