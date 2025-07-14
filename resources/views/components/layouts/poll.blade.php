<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="text-zinc-950 antialiased lg:bg-zinc-100 dark:bg-zinc-900 dark:text-white dark:lg:bg-zinc-950">
    <head>
        @include('partials.head')
    </head>
    <body>
        <flux:container>
            {{ $slot }}
        </flux:container>

        @fluxScripts
    </body>
</html>
