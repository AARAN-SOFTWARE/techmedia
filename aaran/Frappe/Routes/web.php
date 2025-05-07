<?php

use Aaran\Frappe\Livewire\Class;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::get('/stock-list', Class\StockList::class)->name('stock-list');
    Route::get('/stock-balance-query', Class\StockList::class)->name('stock-balance-query');
});
