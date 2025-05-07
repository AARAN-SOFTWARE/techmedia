<?php

namespace Aaran\Search\Livewire\Class;

use Aaran\Frappe\Models\Inventory;
use App\Models\SearchFavorite;
use App\Models\SearchHistory;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class GlobalSearch extends Component
{
    public $query = '';
    public $results = [];

    public $favorites = [];
    public $history = [];
    public bool $searchInitialized = false;

    public function mount()
    {
        $userId = Auth::id();
        $this->favorites = SearchFavorite::where('user_id', $userId)->get();
        $this->history = SearchHistory::where('user_id', $userId)->latest()->take(5)->get();
    }

    public function updatedQuery()
    {
        $query = trim($this->query);

        // Track that user has started interacting
        $this->searchInitialized = true;

        $userId = Auth::id();

        // Save to history only if query is >= 3 chars and not already saved
        if (strlen($query) >= 3) {
            $alreadyExists = SearchHistory::where('user_id', $userId)
                ->where('query', $query)
                ->exists();

            if (!$alreadyExists) {
                SearchHistory::create([
                    'user_id' => $userId,
                    'query' => $query,
                ]);
            }
        }
        if (strlen($query) >= 1) {
            $this->results = Inventory::search($query)
                ->get()
                ->toArray();


        } else {
            $this->results = [];
        }
    }


    public function addToFavorites($type, $name)
    {
        SearchFavorite::firstOrCreate([
            'type' => $type,
            'query' => $name,
            'user_id' => Auth::id(),
        ]);

        $this->favorites = SearchFavorite::where('user_id', Auth::id())->get();
    }

    public function removeFromFavorites($id)
    {
        SearchFavorite::where('id', $id)
            ->where('user_id', Auth::id())
            ->delete();

        // Refresh the favorites list
        $this->favorites = SearchFavorite::where('user_id', Auth::id())->get();
    }

    public function removeFromHistory($id)
    {
        SearchHistory::where('id', $id)
            ->where('user_id', Auth::id())
            ->delete();

        $this->history = SearchHistory::where('user_id', Auth::id())->get();
    }


    public function clearHistory()
    {
        SearchHistory::truncate();
        $this->history = [];
    }

    public function render()
    {
        return view('search::global-search');
    }
}
