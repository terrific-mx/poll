<?php

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Volt\Component;

new
#[Layout('components.layouts.site')]
#[Title('Terrific Poll — Crea encuestas interactivas fácilmente para tu audiencia')]
class extends Component {
    //
};
?>

<div class="space-y-12">
    <header class="space-y-2">
        <x-app-logo-icon class="h-4" />
        <h1 class="font-medium">Bienvenido a Terrific Poll</h1>
    </header>

    <nav class="flex flex-wrap gap-4">
        <flux:link href="#" variant="subtle" class="underline decoration-zinc-800/20 dark:decoration-white/20">Tarifas</flux:link>
        <flux:link href="#" variant="subtle" class="underline decoration-zinc-800/20 dark:decoration-white/20">Connect</flux:link>
        <flux:link href="#" variant="subtle" class="underline decoration-zinc-800/20 dark:decoration-white/20">Changelog</flux:link>
        @if (Route::has('login'))
            @auth
                <flux:link href="{{ route('dashboard') }}" variant="subtle" class="underline decoration-zinc-800/20 dark:decoration-white/20">Panel</flux:link>
            @else
                <flux:link href="{{ route('login') }}" variant="subtle" class="underline decoration-zinc-800/20 dark:decoration-white/20">Iniciar sesión</flux:link>
                <flux:link href="{{ route('register') }}" variant="subtle" class="underline decoration-zinc-800/20 dark:decoration-white/20">Registrarse</flux:link>
            @endauth
        @endif
    </nav>

    <p class="font-medium">Terrific Poll facilita la creación de encuestas interactivas para tu audiencia.</p>
    <ul class="list-disc pl-6 space-y-2">
        <li>Crea encuestas en segundos con una interfaz sencilla.</li>
        <li>Inserta encuestas directamente en tus correos electrónicos o newsletters.</li>
        <li>Recoge respuestas y analiza resultados en tiempo real.</li>
        <li>No se requieren conocimientos técnicos ni de programación.</li>
    </ul>
    <p class="font-medium">¡Comienza hoy y aumenta la participación de tu audiencia!</p>
</div>
