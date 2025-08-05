<?php

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Volt\Component;

new
#[Layout('components.layouts.site')]
#[Title('Terrific Poll — Tarifas')]
class extends Component {
    //
}; ?>

<div class="space-y-8">
    <a href="{{ route('home') }}" class="block" wire:navigate>
        <x-app-logo-icon class="h-4" />
    </a>

    <h1 class="font-medium">Tarifa única, sin límites</h1>
    <p class="text-zinc-700 dark:text-zinc-200">Crea encuestas ilimitadas y recibe respuestas ilimitadas por solo <span class="font-medium text-zinc-800 dark:text-zinc-300">$3.99 USD al año</span>.</p>

    <ul class="text-zinc-700 dark:text-zinc-200 space-y-2 mt-1 list-disc ml-5">
        <li>Encuestas ilimitadas</li>
        <li>Respuestas ilimitadas</li>
        <li>30 días de prueba gratis</li>
        <li>Cancela cuando quieras</li>
    </ul>

    <p class="text-zinc-700 dark:text-zinc-200">Sin cargos ocultos. Paga solo $3.99 USD al año después de la prueba gratuita. Cancela en cualquier momento desde tu panel.</p>

    <p>
        <flux:link href="{{ route('register') }}">Comenzar prueba gratis</flux:link>
    </p>
</div>
