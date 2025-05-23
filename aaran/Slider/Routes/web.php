<?php

use Aaran\Slider\Livewire\Class;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::get('/sliders', Class\SliderList::class)->name('sliders');
    Route::get('/slider-quotes/{id}', Class\SliderQuoteList::class)->name('slider-quotes');
    Route::get('/slider-show/{id}', Class\SliderShow::class)->name('slider-show');
});
