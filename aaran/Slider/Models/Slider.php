<?php

namespace Aaran\Slider\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $guarded = [];

    public function scopeActive(Builder $query, $status = '1'): Builder
    {
        return $query->where('active_id', $status);
    }

    public function scopeSearchByName(Builder $query, string $search): Builder
    {
        return $query->where('item', 'like', "%$search%")
            ->orWhere('item_group', 'like', "%$search%")
            ->orWhere('brand', 'like', "%$search%");
    }
}
