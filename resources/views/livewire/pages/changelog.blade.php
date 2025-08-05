<?php

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Volt\Component;

new
#[Layout('components.layouts.site')]
#[Title('Terrific Poll — Changelog')]
class extends Component {
    //
}; ?>

<div class="space-y-8">
    <a href="{{ route('home') }}" class="block" wire:navigate>
        <x-app-logo-icon class="h-4" />
    </a>

    <h1 class="font-medium">Changelog</h1>
    <p class="text-zinc-700 dark:text-zinc-200">Últimos cambios y mejoras en Terrific Poll.</p>

    <!-- Aquí irá el contenido del changelog -->
</div>
