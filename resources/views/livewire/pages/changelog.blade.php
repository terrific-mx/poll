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

    <ul class="space-y-4 flex flex-col">
        <flux:link
            href="https://world.hey.com/oliver.servin/encuestas-mas-visuales-y-utiles-0a31bfeb"
            external
        >Encuestas más visuales y útiles</flux:link>
        <flux:link
            href="https://world.hey.com/oliver.servin/prellenado-automatico-del-correo-de-contacto-en-encuestas-incrustadas-en-newsletters-bb77e46c"
            external
        >Prellenado automático del correo de contacto</flux:link>
        <flux:link
            href="https://world.hey.com/oliver.servin/las-respuestas-a-encuestas-ahora-pueden-incluir-correo-de-contacto-c9c32d60"
            external
        >Respuestas con correo de contacto</flux:link>
        <flux:link
            href="https://world.hey.com/oliver.servin/las-encuestas-ahora-usan-ulid-en-las-urls-d009713d"
            external
        >Encuestas con ULID</flux:link>
        <flux:link
            href="https://world.hey.com/oliver.servin/hasta-10-respuestas-por-encuesta-1075d25f"
            external
        >Hasta 10 respuestas por encuesta</flux:link>
    </ul>
</div>
