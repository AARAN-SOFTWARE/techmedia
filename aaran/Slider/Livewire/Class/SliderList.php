<?php

namespace Aaran\Slider\Livewire\Class;

use Aaran\Assets\Traits\ComponentStateTrait;
use Aaran\Slider\Models\SlideQuotes;
use Aaran\Slider\Models\Slider;
use Illuminate\Support\Str;
use Livewire\Attributes\Validate;
use Livewire\Component;

class SliderList extends Component
{
    use ComponentStateTrait;

    #[Validate]
    public string $name = '';
    public string $header = '';
    public string $bg_colour = '';
    public string $txt_colour = '';
    public string $fill_colour = '';
    public string $tagline = '';
    public string $tagline_2 = '';
    public string $link_name = '';
    public string $link_to = '';
    public bool $active_id = true;

    public function rules(): array
    {
        return [
            'name' => 'required' . ($this->vid ? '' : "|unique:sliders,name"),
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => ':attribute is missing.',
            'name.unique' => 'This :attribute is already created.',
        ];
    }

    public function validationAttributes(): array
    {
        return [
            'name' => 'Slider name',
        ];
    }

    public function getSave(): void
    {
        $this->validate();

        Slider::query()->updateOrCreate(
            ['id' => $this->vid],
            [
                'name' => Str::ucfirst($this->name),
                'link_name' => $this->link_name,
                'link_to' => $this->link_to,
                'active_id' => $this->active_id,
            ],
        );

        SliderShow::where('slider_id', $this->vid)->delete();

        SlideQuotes::query()->create([
            'slider_id' => $this->vid,
            'header' => $this->header,
            'bg_colour' => $this->bg_colour,
            'txt_colour' => $this->txt_colour,
            'fill_colour' => $this->fill_colour,
            'tagline' => $this->tagline,
            'tagline_2' => $this->tagline_2,
            'active_id' => $this->active_id,
        ],
        );

        $this->dispatch('notify', ...['type' => 'success', 'content' => ($this->vid ? 'Updated' : 'Saved') . ' Successfully']);
        $this->clearFields();
    }

    public function clearFields(): void
    {
        $this->vid = null;
        $this->name = '';
        $this->header = '';
        $this->bg_colour = '';
        $this->txt_colour = '';
        $this->fill_colour = '';
        $this->tagline = '';
        $this->tagline_2 = '';
        $this->link_name = '';
        $this->link_to = '';
        $this->active_id = true;
        $this->searches = '';
    }

    public function getObj(int $id): void
    {
        if ($obj = Slider::query()->find($id)) {
            $this->vid = $obj->id;
            $this->name = $obj->name;
            $this->header = $obj->header;
            $this->bg_colour = $obj->bg_colour;
            $this->txt_colour = $obj->txt_colour;
            $this->fill_colour = $obj->fill_colour;
            $this->tagline = $obj->tagline;
            $this->tagline_2 = $obj->tagline_2;
            $this->link_name = $obj->link_name;
            $this->link_to = $obj->link_to;
            $this->active_id = $obj->active_id;
        }
    }

    public function getList()
    {
        return Slider::query()
            ->active($this->activeRecord)
            ->when($this->searches, fn($query) => $query->searchByName($this->searches))
            ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
            ->paginate($this->perPage);
    }

    public function deleteFunction(): void
    {
        if (!$this->deleteId) return;

        $obj = Slider::query()->find($this->deleteId);
        if ($obj) {
            $obj->delete();
        }
    }

    public function render()
    {
        return view('slider::slider-list', [
            'list' => $this->getList()
        ]);
    }
}
