<?php

namespace Aaran\Frappe\Livewire\Class;

use Aaran\Assets\Traits\ComponentStateTrait;
use Aaran\Frappe\Models\Inventory;
use Aaran\Frappe\Services\ErpNextService;
use App\Jobs\InvetoryJob;
use Exception;
use Livewire\Component;

class StockShow extends Component
{
    use ComponentStateTrait;

    public $item;

    public function mount($id)
    {
        if ($id){
            $this->item = Inventory::find($id);
        }
    }

    public function render()
    {
        return view('frappe::stock-show');
    }
}
