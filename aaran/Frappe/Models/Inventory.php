<?php

namespace Aaran\Frappe\Models;

use Aaran\Frappe\Database\Factories\InventoryFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function scopeSearchByName(Builder $query, string $search): Builder
    {
        return $query->where('item', 'like', "%$search%")
            ->orWhere('item_group', 'like', "%$search%")
            ->orWhere('brand', 'like', "%$search%");
    }

    protected static function newFactory(): InventoryFactory
    {
        return InventoryFactory::new();
    }
}
