<?php

namespace Aaran\Website\Livewire\Class;

use Livewire\Attributes\Layout;
use Livewire\Component;

class Index extends Component
{
    public $slides = [];

    public function mount(): void
    {
//        $this->slides = SlideQuotes::all();
    }

    #[Layout('Ui::components.layouts.web')]
    public function render()
    {
        return view('website::index');
    }
}
