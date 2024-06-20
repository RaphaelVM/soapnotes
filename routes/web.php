<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('notes')->group(function () {
    Route::get('/', \App\Livewire\Notes\Index::class)->name('notes.index');
    Route::get('/{uuid}', \App\Livewire\Notes\Show::class)->name('notes.show');
    Route::get('/create/form', \App\Livewire\Notes\Create::class)->name('notes.create');
    Route::get('/{uuid}/edit', \App\Livewire\Notes\Edit::class)->name('notes.edit');
});

Route::prefix('categories')->group(function () {
    Route::get('/', \App\Livewire\Categories\Index::class)->name('categories.index');
    Route::get('/{uuid}', \App\Livewire\Categories\Show::class)->name('categories.show');
    Route::get('/create/form', \App\Livewire\Categories\Create::class)->name('categories.create');
    Route::get('/{uuid}/edit', \App\Livewire\Categories\Edit::class)->name('categories.edit');
});
