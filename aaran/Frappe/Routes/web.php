<?php

use Aaran\Frappe\Livewire\Class;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::get('/stock-client/{id}', Class\StockClient::class)->name('stock-client');
    Route::get('/stock-sync', Class\StockSync::class)->name('stock-sync');
    Route::get('/stock-list', Class\StockList::class)->name('stock-list');
    Route::get('/stock-show/{id}', Class\StockShow::class)->name('stock-show');
});
