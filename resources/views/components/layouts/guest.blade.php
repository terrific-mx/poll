<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark antialiased">
    <head>
        @include('partials.head')
    </head>
    <body>
        <flux:main>
            {{ $slot }}
        </flux:main>

        @fluxScripts
    </body>
</html>
