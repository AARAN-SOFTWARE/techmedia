<?php

namespace Aaran\Frappe\Livewire\Class;

use Aaran\Assets\Traits\ComponentStateTrait;
use Aaran\Frappe\Models\StockBalance;
use Aaran\Frappe\Services\ErpNextService;
use Exception;
use Livewire\Component;

class StockList extends Component
{
    use ComponentStateTrait;

    public $selected = 'Wireless Mouse';
    public $stockData = [];

    protected ErpNextService $erpNextService;

    public function mount()
    {
        $this->getStockBalanceReport();
    }

    public function updatedSelected(): void
    {
        $this->getStockBalanceReport();
    }


    public function getStockBalanceReport()
    {
        $this->stockData = StockBalance::query()
            ->when($this->searches, fn($query) => $query->searchByName($this->searches))
            ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
            ->paginate($this->perPage);

    }

    public function syncStock(): void
    {
        $this->erpNextService = new ErpNextService();

        try {
            $url = $this->erpNextService->baseUrl . "/api/method/frappe.desk.query_report.run";

            $response = $this->erpNextService->client()->get($url, [
                'report_name' => 'Stock Balance',
                'ignore_prepared_report' => 'True',
                'filters' => json_encode([
                    'item_group' => $this->selected,
                    'to_date' => '2025-01-03',
                ])
            ]);

            $this->stockData = $this->erpNextService->handleResponse($response)['message']['result'] ?? [];

            if (!empty($stockData)) {

                StockBalance::query()->truncate();

                foreach ($this->stockData as $row) {
                    if (!empty($row['item_code'])) {
                        StockBalance::query()->Create(
                            [
                                'item' => $row['item_code'],
                                'item_group' => $row['item_group'],
                                'brand' => $row['brand'],
                                'warehouse' => $row['warehouse'],
                                'balance_qty' => $row['bal_qty'],
                                'balance_value' => $row['bal_val'],
                                'valuation_rate' => $row['val_rate'],
                                'price' => $row['price'],
                            ],
                        );
                    }
                }
            }

        } catch (Exception $e) {
            $this->stockData = [];
            report($e);
        }
    }

    public function render()
    {
        return view('frappe::stock-list');
    }
}
