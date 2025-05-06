<?php

use Aaran\Website\Livewire\Class;
use Illuminate\Support\Facades\Route;

Route::get('/', Class\Index::class)->name('home');

