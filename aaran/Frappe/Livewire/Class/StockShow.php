<?php

namespace Aaran\Frappe\Livewire\Class;

use Aaran\Assets\Traits\ComponentStateTrait;
use Aaran\Frappe\Jobs\StockBalanceSyncJob;
use Aaran\Frappe\Models\StockBalance;
use Aaran\Frappe\Services\ErpNextService;
use Exception;
use Livewire\Component;

class StockShow extends Component
{
    use ComponentStateTrait;

    protected ErpNextService $erpNextService;

    public $selected = 'Wireless Mouse';
    public $stockData = [];
    public $item;
    public mixed $item_detail;

    public function mount($id)
    {
        if ($id) {
            $this->item = StockBalance::find($id);
        }
        $this->itemWisePurchase();
        $this->itemPrice();
        $this->itemDetail();
    }

    public function itemWisePurchase()
    {
        $this->erpNextService = new ErpNextService();

        try {
            $url = $this->erpNextService->baseUrl . "/api/method/frappe.desk.query_report.run";

            $response = $this->erpNextService->client()->get($url, [
                'report_name' => 'item-wise Purchase Register',
                'ignore_prepared_report' => 'True',
                'filters' => json_encode([
                    'item_code' => $this->item['item_code'],
//                    'to_date' => now()->format('Y-m-d'),
                ])
            ]);

            $this->stockData = $this->erpNextService->handleResponse($response)['message']['result'] ?? [];

        } catch (Exception $e) {
            $this->stockData = [];
            report($e);
        }

    }

    public $item_price = [];

    public function itemPrice()
    {
        $this->erpNextService = new ErpNextService();

        try {
            $url = $this->erpNextService->baseUrl . "/api/resource/Item%20Price";

            $filters = [
                ["Item Price", "item_code", "=", $this->item['item_code']],
            ];

            $fields = ['name', 'item_code', 'item_name', 'brand', 'item_description', 'price_list', 'buying', 'selling', 'price_list_rate'];

            $queryParams = [
                'filters' => json_encode($filters),
                'fields' => json_encode($fields),
            ];

//             dd($url . '?' . http_build_query($queryParams));

            $response = $this->erpNextService->client()->get($url . '?' . http_build_query($queryParams));

            $this->item_price = $this->erpNextService->handleResponse($response)['data'] ?? [];

//            dd($this->item_price);

        } catch (Exception $e) {
            $this->item_price = [];
            report($e);
        }
    }

    public function itemDetail()
    {
        $this->erpNextService = new ErpNextService();

        try {
            $url = $this->erpNextService->baseUrl . "/api/resource/Item";

            $filters = [
                ["Item", "item_code", "=", $this->item['item_code']],
            ];

            $fields = ['name', 'item_code', 'item_name', 'brand', 'image'];

            $queryParams = [
                'filters' => json_encode($filters),
                'fields' => json_encode($fields),
            ];

//             dd($url . '?' . http_build_query($queryParams));

            $response = $this->erpNextService->client()->get($url . '?' . http_build_query($queryParams));

            $this->item_detail = $this->erpNextService->handleResponse($response)['data'][0] ?? [];

            //            dd($item_detail['name']);

        } catch (Exception $e) {
            $this->item_detail = null;
            report($e);
        }
    }


    public function render()
    {
        return view('frappe::stock-show');
    }
}
