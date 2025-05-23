<?php

namespace Aaran\Frappe\Livewire\Class;

use Aaran\Assets\Traits\ComponentStateTrait;
use Aaran\Frappe\Jobs\StockBalanceSyncJob;
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

    public function getList()
    {
        $this->perPage = '500';

        return StockBalance::search(trim($this->searches))
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
                    'to_date' => now()->format('Y-m-d'),
                ])
            ]);

            $this->stockData = $this->erpNextService->handleResponse($response)['message']['result'] ?? [];

            set_time_limit(300); // 5 minutes
            StockBalanceSyncJob::dispatchSync($this->stockData);

        } catch (Exception $e) {
            $this->stockData = [];
            report($e);
        }
    }

    public function render()
    {
        return view('frappe::stock-list', [
            'list' => $this->getList()
        ]);
    }
}
