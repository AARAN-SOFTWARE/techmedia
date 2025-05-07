<?php

namespace Aaran\Frappe\Livewire\Class;

use Aaran\Assets\Traits\ComponentStateTrait;
use Aaran\Frappe\Models\StockBalance;
use Livewire\Component;

class StockShow extends Component
{
    use ComponentStateTrait;

    public $item;

    public function mount($id)
    {
        if ($id){
            $this->item = StockBalance::find($id);
        }
    }

    public function render()
    {
        return view('frappe::stock-show');
    }
}
