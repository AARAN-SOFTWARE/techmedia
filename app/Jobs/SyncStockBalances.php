<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SyncStockBalances implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected array $stockData;

    /**
     * Create a new job instance.
     */
    public function __construct(array $stockData)
    {
        $this->stockData = $stockData;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
// Check if stockData is empty
            if (empty($this->stockData)) {
                Log::info('No stock data to process.');
                return;
            }

// Truncate the table
            DB::table('stock_balances')->truncate();

            $formattedRows = [];

            foreach ($this->stockData as $row) {
                if (!empty($row['item_code'])) {
                    $formattedRows[] = [
                        'item' => $row['item_code'],
                        'item_group' => $row['item_group'] ?? null,
                        'brand' => $row['brand'] ?? null,
                        'warehouse' => $row['warehouse'] ?? null,
                        'balance_qty' => $row['bal_qty'] ?? 0,
                        'balance_value' => $row['bal_val'] ?? 0,
                        'valuation_rate' => $row['val_rate'] ?? 0,
                        'price' => $row['price'] ?? 0,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
            }

// Insert data in chunks
            foreach (array_chunk($formattedRows, 500) as $chunk) {
                DB::table('stock_balances')->insert($chunk);
            }

            Log::info('Stock balances have been successfully synchronized.');

        } catch (\Exception $e) {
            Log::error('Error syncing stock balances: ' . $e->getMessage());
        }
    }
}
