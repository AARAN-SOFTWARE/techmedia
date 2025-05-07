<?php

namespace Aaran\Slider\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class SlideQuotes extends Model
{
    protected $guarded = [];
    public function scopeActive(Builder $query, $status = '1'): Builder
    {
        return $query->where('active_id', $status);
    }
}
