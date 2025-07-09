<?php

use App\Http\Controllers\PollResponseController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Volt::route('dashboard', 'dashboard')->name('dashboard');
    Volt::route('polls/create', 'polls.create')->name('polls.create');
});

// Public poll routes
Route::get('/p/{poll}', function (\App\Models\Poll $poll) {
    // For now, just return a 200 OK response (can be replaced with a view later)
    return response()->noContent(200);
});
Route::post('/p/{poll}', [PollResponseController::class, 'store']);

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';
