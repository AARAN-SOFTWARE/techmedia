<?php

namespace Aaran\Frappe\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class StockBalance extends Model
{
    protected $guarded = [];

    public function scopeSearchByName(Builder $query, string $search): Builder
    {
        return $query->where('item', 'like', "%$search%")
            ->orWhere('item_group', 'like', "%$search%")
            ->orWhere('brand', 'like', "%$search%");
    }
}
