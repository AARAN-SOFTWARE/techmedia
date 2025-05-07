<?php

namespace Aaran\Search\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SearchHistory extends Model
{
    /** @use HasFactory<\Aaran\Search\Database\Factories\SearchHistoryFactory> */
    use HasFactory;

    protected $guarded = [];

}
