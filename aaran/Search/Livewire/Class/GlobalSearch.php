<?php

namespace Aaran\Search\Livewire\Class;

use App\Models\User;
use Livewire\Component;

class GlobalSearch extends Component
{
    public $query = '';
    public $results = [];

    public function updatedQuery()
    {
        $this->results = User::where('name', 'like', "%{$this->query}%")
            ->orWhere('email', 'like', "%{$this->query}%")
            ->take(10)
            ->get()
            ->toArray(); // Replace with your actual searchable models
    }

    public function render()
    {
        return view('search::global-search');
    }
}
