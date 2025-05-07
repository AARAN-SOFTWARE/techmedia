<?php

namespace Aaran\Slider\Livewire\Class;

use Aaran\Assets\Traits\ComponentStateTrait;
use Aaran\Slider\Models\Slider;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

class SliderShow extends Component
{
    use ComponentStateTrait;

    public Slider $slider;

    public function mount(int $id): void
    {
        if ($id) {
            $this->slider = Slider::query()->find($id);
        }
    }

    #[Layout('Ui::components.layouts.guest')]
    public function render()
    {
        return view('slider::slider-show');
    }
}
