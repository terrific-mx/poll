<?php

use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('components.layouts.site')] class extends Component {
    //
};
?>

<div class="space-y-12">
    @if (Route::has('login'))
        <p>
            @auth
                <flux:link href="{{ route('dashboard') }}">Dashboard</flux:link>
            @else
                <flux:link href="{{ route('login') }}">Log In</flux:link>
                <flux:link href="{{ route('register') }}">Register</flux:link>
            @endauth
        </p>
    @endif
    <h1 class="font-medium">Welcome to Terrific Poll</h1>
    <p class="font-medium">Terrific Poll makes it easy to create interactive polls for your audience.</p>
    <ul class="list-disc pl-6 space-y-2">
        <li>Create polls in seconds with a simple interface.</li>
        <li>Embed polls directly into your emails or newsletters.</li>
        <li>Collect responses and analyze results in real time.</li>
        <li>No coding or technical skills required.</li>
    </ul>
    <p class="font-medium">Get started today and boost engagement with your audience!</p>
</div>
