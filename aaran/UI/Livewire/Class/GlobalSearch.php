<?php

namespace Aaran\UI\Livewire\Class;

use Livewire\Component;

class GlobalSearch extends Component
{
    public $query = '';
    public $results = [];

    public function updatedQuery()
    {
        $this->results = \App\Models\User::where('name', 'like', "%{$this->query}%")
            ->orWhere('email', 'like', "%{$this->query}%")
            ->take(10)
            ->get()
            ->toArray(); // Replace with your actual searchable models
    }

    public function render()
    {
        return view('comp::global-search');
    }
}
