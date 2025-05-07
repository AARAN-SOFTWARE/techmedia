<?php

namespace Aaran\Frappe\Database\Seeders;

use Aaran\Frappe\Models\StockBalance;
use Illuminate\Database\Seeder;

class StockBalanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        StockBalance::create([
            'item_code' => '20002',
            'item_group' => 'Test Item Group',
            'item_name' => 'Test Item',
            'brand' => 'Test Brand',
            'warehouse' => 'Test Warehouse',
            'opening_qty' => 20,
            'opening_val' => 20,
            'balance_qty' => 20,
            'balance_val' => 20,
            'valuation_rate' => 20,
        ]);
    }
}
