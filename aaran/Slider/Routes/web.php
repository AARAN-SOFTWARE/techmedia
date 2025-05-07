<?php

use Aaran\Slider\Livewire\Class;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::get('/sliders', Class\SliderList::class)->name('sliders');
    Route::get('/sliders-quotes/{id}', Class\SliderQuoteList::class)->name('sliders-quotes');
    Route::get('/sliders-show/{id}', Class\SliderShow::class)->name('slider-show');
});
