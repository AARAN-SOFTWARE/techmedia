<?php

namespace Aaran\Frappe\Database\Factories;

use Aaran\Frappe\Models\Inventory;
use Illuminate\Database\Eloquent\Factories\Factory;

class InventoryFactory extends Factory
{

    protected $model = Inventory::class;

    public function definition(): array
    {
        return [
            'item_code' => fake()->numberBetween(1000, 5000),
            'item_group' => fake()->domainName(),
            'item_name' => fake()->name,
            'brand' => fake()->safeColorName(),
            'warehouse' => 'Test Warehouse',
            'opening_qty' => fake()->numberBetween(10, 5000),
            'opening_val' => fake()->numberBetween(10, 5000),
            'balance_qty' => fake()->numberBetween(10, 5000),
            'balance_val' => fake()->numberBetween(10, 5000),
            'valuation_rate' => fake()->numberBetween(10, 5000),
        ];
    }
}
