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
                <flux:link href="{{ route('dashboard') }}">Panel</flux:link>
            @else
                <flux:link href="{{ route('login') }}">Iniciar sesión</flux:link>
                <flux:link href="{{ route('register') }}">Registrarse</flux:link>
            @endauth
        </p>
    @endif
    <h1 class="font-medium">Bienvenido a Terrific Poll</h1>
    <p class="font-medium">Terrific Poll facilita la creación de encuestas interactivas para tu audiencia.</p>
    <ul class="list-disc pl-6 space-y-2">
        <li>Crea encuestas en segundos con una interfaz sencilla.</li>
        <li>Inserta encuestas directamente en tus correos electrónicos o newsletters.</li>
        <li>Recoge respuestas y analiza resultados en tiempo real.</li>
        <li>No se requieren conocimientos técnicos ni de programación.</li>
    </ul>
    <p class="font-medium">¡Comienza hoy y aumenta la participación de tu audiencia!</p>
</div>
