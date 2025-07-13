<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\ThankYouController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Volt::route('dashboard', 'dashboard')->name('dashboard');
    Volt::route('polls/create', 'polls.create')->name('polls.create');
});

// Public poll routes using Volt component
Volt::route('p/{poll}', 'polls.vote')->name('polls.public.show');

Route::get('/p/{poll}/thank-you', [ThankYouController::class, 'show'])->name('polls.public.thankyou');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';
