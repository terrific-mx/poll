<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="antialiased">
    <head>
        @include('partials.head')
    </head>
    <body class="bg-zinc-50">
        <header class="sticky flex justify-end p-6 gap-4">
            @auth
                <flux:button :href="route('dashboard')" variant="primary" color="amber" size="sm" wire:navigate>{{ __('Dashboard') }}</flux:button>
            @else
                <flux:button :href="route('login')" variant="subtle" size="sm" wire:navigate>Iniciar sesión</flux:button>
<flux:button :href="route('register')" variant="primary" color="amber" size="sm" wire:navigate>Comenzar ahora</flux:button>
            @endauth
        </header>

        <main class="
            mx-auto mb-8 max-w-3xl px-4 mt-20
            text-zinc-700
            [&>h1]:text-center [&>h1]:font-medium [&>h1]:text-5xl [&>h1]:tracking-tight [&>h1]:text-zinc-950
            [&>h2]:font-medium [&>h2]:tracking-tight [&>h2]:text-2xl [&>h2]:text-zinc-950
            [&>[data-lead]]:text-center [&>[data-lead]]:text-xl [&>[data-lead]]:text-zinc-900
            [&>p]:text-lg
            [&>p>strong]:text-zinc-950
        ">
            <h1>Agrega encuestas interactivas a tus emails y newsletters</h1>
<p class="max-w-lg mx-auto mt-6" data-lead>
    Consigue más respuestas y conoce mejor a tu audiencia con un solo clic.
</p>
<div class="mt-6 text-center text-sm">
    Creado por <span class="text-zinc-950">Oliver Servín</span>
</div>

            <p class="mt-48">
    Esta plataforma funciona en la nube y está diseñada para que puedas crear y compartir encuestas en minutos, sin complicaciones.
</p>
<p class="mt-6">
    Olvídate de procesos manuales o integraciones complejas: simplemente crea tu encuesta, copia el enlace o el bloque de código, y agrégalo a tu email o newsletter.
</p>

            <flux:card class="min-h-72 mt-10 flex flex-col">
                <div class="flex-1 flex flex-col justify-end">
                    <div class="flex justify-center">
                        <flux:button size="sm">{{ __('Start demo') }}</flux:button>
                    </div>
                </div>
            </flux:card>

            <h2 class="mt-20">Todo lo que necesitas para encuestar a tu audiencia</h2>
<p class="mt-6">
    Crea encuestas atractivas y agrégalas fácilmente a tus emails y newsletters, sin importar qué plataforma uses.
</p>
<p class="mt-6">
    Recibe respuestas en tiempo real y obtén feedback valioso de tu audiencia con solo un clic.
</p>
<p class="mt-6">
    Un panel de analíticas te muestra la participación y los resultados de tus encuestas para que puedas tomar mejores decisiones.
</p>

            <h2 class="mt-20">Empieza en minutos</h2>
<p class="mt-6">
    Solo regístrate, crea tu primera encuesta y compártela con tu audiencia. No necesitas conocimientos técnicos ni configuraciones avanzadas.
</p>
<p class="mt-6">
    El panel te permite ver todas tus encuestas, analizar resultados y mejorar la participación de tus lectores fácilmente.
</p>

            <h2 class="mt-20">Aumenta la participación y obtén feedback real</h2>
<p class="mt-6">
    Tus lectores pueden responder encuestas directamente desde su email, sin salir de su bandeja de entrada.
</p>
<p class="mt-6">
    Recibe resultados al instante y descubre qué piensan realmente sobre tu contenido, productos o ideas.
</p>
<p class="mt-6">
    Ideal para newsletters, comunidades, cursos y cualquier persona que quiera conocer mejor a su audiencia.
</p>

            <h2 class="mt-20">Comienza gratis hoy mismo</h2>
<p class="mt-6">
    Prueba la herramienta sin compromiso y descubre lo fácil que es aumentar la participación en tus emails y newsletters.
</p>
<p class="mt-6">
    No necesitas tarjeta de crédito. Empieza a recibir feedback de tu audiencia desde el primer día.
</p>

            <flux:card class="max-w-lg mx-auto mt-20">
                <h2 class="text-2xl font-medium tracking-tight text-zinc-950 text-center mt-2">Simple, Transparent Pricing</h2>
                <p class="text-center mt-4">Choose a plan that fits your team and get started with confidence—no hidden fees, ever.</p>
                <ul class="mt-9 gap-3 md:grid md:grid-cols-2 md:gap-6 text-sm">
    <li class="flex gap-2">
        <flux:icon.check-circle variant="mini" class="text-green-500" />
        Fácil de integrar en cualquier email o newsletter
    </li>
    <li class="flex gap-2">
        <flux:icon.check-circle variant="mini" class="text-green-500" />
        Funciona con cualquier proveedor de newsletters
    </li>
    <li class="flex gap-2">
        <flux:icon.check-circle variant="mini" class="text-green-500" />
        Recibe respuestas en tiempo real
    </li>
    <li class="flex gap-2">
        <flux:icon.check-circle variant="mini" class="text-green-500" />
        Analíticas de participación y resultados
    </li>
    <li class="flex gap-2">
        <flux:icon.check-circle variant="mini" class="text-green-500" />
        Sin necesidad de código ni integraciones complicadas
    </li>
    <li class="flex gap-2">
        <flux:icon.check-circle variant="mini" class="text-green-500" />
        Soporte prioritario por email
    </li>
    <li class="flex gap-2">
        <flux:icon.check-circle variant="mini" class="text-green-500" />
        Hosting seguro en la nube
    </li>
    <li class="flex gap-2">
        <flux:icon.check-circle variant="mini" class="text-green-500" />
        Prueba gratis por 14 días
    </li>
</ul>
                <flux:button :href="route('register')" variant="primary" color="amber" class="mt-9 w-full text-base!">
    Comenzar ahora
</flux:button>
            </flux:card>

            <div class="mt-64 flex items-center justify-between text-zinc-400">
                <p class="text-sm flex items-center gap-2.5">
                    <x-app-logo-icon class="size-4 text-zinc-300" />
                    <span><strong class="font-medium">flowpilot</strong>.com</span>
                </p>
                <p class="text-sm">by <strong class="font-medium">Oliver Servín</strong></p>
            </div>
        </main>
    </body>
</html>
