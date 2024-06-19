<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('notes')->group(function () {
    Route::get('/', \App\Livewire\Notes\Index::class);
    Route::get('/{uuid}', \App\Livewire\Notes\Show::class);
    Route::get('/create', \App\Livewire\Notes\Create::class);
    Route::get('/{uuid}/edit', \App\Livewire\Notes\Edit::class);
});
