<?php

namespace Aaran\Frappe\Livewire\Class;

use Aaran\Assets\Traits\ComponentStateTrait;
use Aaran\Frappe\Jobs\StockBalanceSyncJob;
use Aaran\Frappe\Models\StockBalance;
use Aaran\Frappe\Services\ErpNextService;
use Exception;
use Livewire\Component;

class StockSync extends Component
{
    use ComponentStateTrait;


    public $vdate = '';
    public $stockData = [];

    protected ErpNextService $erpNextService;

    public function getList()
    {
        return StockBalance::search(trim($this->searches))
            ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
            ->paginate($this->perPage);
    }

    public function syncStock(): void
    {
        $this->vdate = $this->vdate ?: now()->format('Y-m-d');

        $this->erpNextService = new ErpNextService();


        try {
            $url = $this->erpNextService->baseUrl . "/api/method/frappe.desk.query_report.run";

            $response = $this->erpNextService->client()->get($url, [
                'report_name' => 'Stock Balance',
                'ignore_prepared_report' => 'True',
                'filters' => json_encode([
                    'to_date' => $this->vdate,
                ])
            ]);

            $this->stockData = $this->erpNextService->handleResponse($response)['message']['result'] ?? [];

            set_time_limit(300); // 5 minutes
            StockBalanceSyncJob::dispatchSync($this->stockData);

//            $this->redirect(route('stock-list'));

        } catch (Exception $e) {
            $this->stockData = [];
            report($e);
        }
    }

    public function render()
    {
        $this->vdate = now()->format('Y-m-d');

        return view('frappe::stock-sync', [
            'list' => $this->getList()
        ]);
    }
}
