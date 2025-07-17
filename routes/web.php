<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::redirect('/', 'polls')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::redirect('dashboard', 'polls')->name('dashboard');
    Volt::route('polls', 'polls.index')->name('polls.index');
    Volt::route('polls/create', 'polls.create')->name('polls.create');
    Volt::route('polls/{poll}', 'polls.show')->name('polls.show');
});

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

Volt::route('p/{poll}', 'polls.respond')->name('polls.respond');

require __DIR__.'/auth.php';
