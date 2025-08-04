<?php

use App\Http\Middleware\EnsureUserIsSubscribed;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Volt::route('/', 'pages.welcome')->name('home');

Volt::route('p/{poll}', 'pages.polls.vote')->name('polls.vote');

Route::middleware(['auth', 'verified', EnsureUserIsSubscribed::class])->group(function () {
    Volt::route('dashboard', 'pages.dashboard')->name('dashboard');

    Volt::route('polls/{poll}', 'pages.polls.show')->name('polls.show');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Volt::route('subscribe', 'pages.subscribe')->name('subscribe');
    Volt::route('subscription-required', 'pages.subscription-required')->name('subscription-required');
});

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';
