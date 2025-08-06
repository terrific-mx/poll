<?php

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Volt\Component;

new
#[Layout('components.layouts.site')]
#[Title('Terrific Poll — Crea encuestas interactivas fácilmente para tu audiencia')]
class extends Component {
    public $demoSubmitted = false;

    #[Validate('required')]
    public $demoResponse = '';

    public function demoSubmit()
    {
        $this->validate();

        $this->demoSubmitted = true;
    }
}; ?>

<div class="space-y-12">
    <header class="space-y-8">
        <a href="{{ route('home') }}" class="block" wire:navigate>
            <x-app-logo-icon class="h-4" />
        </a>
        <h1 class="font-medium">Agrega encuestas interactivas a tus emails y newsletters</h1>
    </header>

    <nav class="flex flex-wrap gap-4">
        <flux:link :href="route('pricing')" variant="subtle" class="underline decoration-zinc-800/20 dark:decoration-white/20" wire:navigate>Tarifas</flux:link>

        <flux:link :href="route('changelog')" variant="subtle" class="underline decoration-zinc-800/20 dark:decoration-white/20" wire:navigate>Changelog</flux:link>

        <flux:link :href="route('connect')" variant="subtle" class="underline decoration-zinc-800/20 dark:decoration-white/20" wire:navigate>Contacto</flux:link>

        @if (Route::has('login'))
            @guest
                <flux:link href="{{ route('login') }}" variant="subtle" class="underline decoration-zinc-800/20 dark:decoration-white/20" wire:navigate>Iniciar sesión</flux:link>
            @endif
        @endif
    </nav>

    <div class="space-y-8">
        <p class="text-zinc-700 dark:text-zinc-200">Terrific Poll te permite agregar encuestas interactivas a tus emails y newsletters, incluso si tu proveedor de newsletters no lo permite. Es la forma más fácil de aumentar la participación y recopilar feedback de tu audiencia.</p>
        <div class="space-y-4 flex flex-col">
            @auth
                <flux:link href="{{ route('dashboard') }}" variant="primary">Ir al panel</flux:link>
            @else
                <flux:link href="{{ route('register') }}">Comenzar ahora</flux:link>
            @endauth
            <flux:link
                href="https://world.hey.com/oliver.servin/terrific-poll-la-forma-mas-facil-de-agregar-encuestas-a-tus-emails-y-newsletters-b6fd1f41"
                external
            >Presentación</flux:link>
        </div>

        <flux:card class="bg-zinc-50 dark:bg-zinc-800">
            @if ($demoSubmitted)
                <div class="p-6 text-center text-zinc-700 dark:text-zinc-200">
                    <strong>¡Gracias por tu respuesta!</strong>
                    <div>Así funciona una encuesta demo en Terrific Poll.</div>
                </div>
            @else
                <form wire:submit="demoSubmit" class="space-y-6">
                    <flux:radio.group wire:model="demoResponse" label="¿Qué tan probable es que recomiendes nuestro newsletter a un amigo?" required>
                        <flux:radio value="very" label="Muy probable" />
                        <flux:radio value="somewhat" label="Algo probable" />
                        <flux:radio value="not_at_all" label="Nada probable" />
                    </flux:radio.group>

                    <flux:button type="submit" variant="primary">Enviar</flux:button>
                </form>
            @endif
        </flux:card>
    </div>
</div>
