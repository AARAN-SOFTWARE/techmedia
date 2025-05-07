<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class InvetoryJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected array $stockData;

    public function __construct(array $stockData)
    {
        $this->stockData = $stockData;
    }

    public function handle(): void
    {
        try {
            // Check if stockData is empty
            if (empty($this->stockData)) {
                Log::info('No stock data to process.');
                return;
            }

            // Truncate the table
            DB::table('inventories')->truncate();

            $formattedRows = [];

            foreach ($this->stockData as $row) {
                if (!empty($row['item_code'])) {

                    $formattedRows[] = [
                        'item_code' => $row['item_code'],
                        'item_group' => $row['item_group'] ?? null,
                        'item_name' => $row['item_name'] ?? null,
                        'brand' => $row['brand'] ?? null,
                        'warehouse' => $row['warehouse'] ?? null,
                        'opening_qty' => $row['opening_qty'] ?? 0,
                        'opening_val' => $row['opening_val'] ?? 0,
                        'balance_qty' => $row['bal_qty'] ?? 0,
                        'balance_val' => $row['bal_val'] ?? 0,
                        'valuation_rate' => $row['val_rate'] ?? 0,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
            }

            // Insert data in chunks
            foreach (array_chunk($formattedRows, 500) as $chunk) {
                DB::table('inventories')->insert($chunk);
            }

            Log::info('Stock balances have been successfully synchronized.');

        } catch (\Exception $e) {
            Log::error('Error syncing stock balances: ' . $e->getMessage());
        }
    }
}
