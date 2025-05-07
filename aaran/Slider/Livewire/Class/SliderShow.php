<?php

namespace Aaran\Slider\Livewire\Class;

use Aaran\Assets\Traits\ComponentStateTrait;
use Aaran\Slider\Models\SlideQuotes;
use Aaran\Slider\Models\Slider;
use Livewire\Attributes\Layout;
use Livewire\Component;

class SliderShow extends Component
{
    use ComponentStateTrait;

    public Slider $slide;
    public $sliders;

    public function mount(int $id): void
    {
        if ($id) {
            $this->slide = Slider::query()->find($id);
            $this->sliders = SlideQuotes::query()->where('slider_id', $this->slide->id)->get();
        }
    }

    #[Layout('Ui::components.layouts.guest')]
    public function render()
    {
        return view('slider::slider-show');
    }
}
