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
    <header class="space-y-8">
        <x-app-logo-icon class="h-4" />
        <h1 class="font-medium">Agrega encuestas interactivas a tus emails y newsletters</h1>
    </header>

    <nav class="flex flex-wrap gap-4">
        <flux:link :href="route('pricing')" variant="subtle" class="underline decoration-zinc-800/20 dark:decoration-white/20">Tarifas</flux:link>
        <flux:link href="#" variant="subtle" class="underline decoration-zinc-800/20 dark:decoration-white/20">Connect</flux:link>
        <flux:link href="#" variant="subtle" class="underline decoration-zinc-800/20 dark:decoration-white/20">Changelog</flux:link>
        @if (Route::has('login'))
            <flux:link href="{{ route('login') }}" variant="subtle" class="underline decoration-zinc-800/20 dark:decoration-white/20">Iniciar sesión</flux:link>
        @endif
    </nav>

    <p class="text-zinc-700 dark:text-zinc-200">Terrific Poll te permite agregar encuestas interactivas a tus emails y newsletters, incluso si tu proveedor de newsletters no lo permite. Es la forma más fácil de aumentar la participación y recopilar feedback de tu audiencia.</p>

    @auth
        <flux:link href="{{ route('dashboard') }}" variant="primary">Ir al panel</flux:link>
    @else
        <flux:link href="{{ route('register') }}">Comenzar ahora</flux:link>
    @endauth
</div>
