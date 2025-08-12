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
            [&>ul]:text-lg
            [&>p>strong]:text-zinc-950 [&>p>strong]:font-medium
            [&>ul>li>p>strong]:text-zinc-950 [&>ul>li>p>strong]:font-medium
        ">
            <h1>
                Haz que tu audiencia hable
            </h1>
            <p class="max-w-lg mx-auto mt-6" data-lead>
                Agrega encuestas interactivas a cualquier newsletter, sin complicaciones técnicas.
            </p>

            <p class="mt-48">
                <strong>Crea</strong>, <strong>inserta</strong> y <strong>analiza encuestas</strong> en tus correos electrónicos, aunque tu plataforma no las soporte. <strong>Sin código, sin límites, sin dolores de cabeza.</strong>
            </p>

            <p class="mt-6">
                <strong>Ideal para creadores de newsletters, equipos de marketing, agencias y organizaciones</strong> que quieren conocer la opinión de su audiencia—sin importar qué servicio de email utilicen.
            </p>

            <h2 class="mt-20">¿Te gustaría saber qué piensa tu audiencia, pero tu plataforma de newsletters no permite encuestas?</h2>

            <p class="mt-6">
                ¿Cansado de soluciones complicadas, formularios externos o costosos upgrades?
            </p>

            <p class="mt-6">
                Imagina poder insertar una encuesta atractiva en tu próximo correo, sin cambiar de plataforma, sin pagar extras y sin tocar una sola línea de código.
            </p>

            <p class="mt-6">
                Con Terrific Poll, solo tienes que <strong>escribir tu pregunta</strong>, <strong>elegir hasta 10 opciones</strong> y <strong>copiar el contenido generado</strong>. <strong>Pega la encuesta en tu newsletter</strong>—funciona con Beehiiv, Brevo, EmailOctopus, Ghost, HubSpot, Kit, Loops, MailerLite, Sendy y más.
            </p>

            <p class="mt-6">
                Tus lectores <strong>solo hacen clic</strong> en su respuesta favorita. <strong>Automáticamente</strong>, se abre una página de confirmación con su <strong>correo prellenado</strong> (gracias a los merge tags de tu plataforma). Un clic más, y su voto queda registrado.
            </p>

            <p class="mt-6">
                <strong>Tú ves los resultados en tiempo real:</strong>
            </p>

            <ul class="mt-6 space-y-1 list-disc ml-6">
                <li>
                    <p><strong>Número de respuestas por opción</strong></p>
                </li>
                <li>
                    <p><strong>Porcentajes visuales</strong></p>
                </li>
                <li>
                    <p><strong>Tabla detallada</strong> con fecha y correo (si está disponible)</p>
                </li>
            </ul>

            <p class="mt-6">
                <strong>Exporta los datos cuando quieras.</strong> Sin bloqueos, sin ataduras, sin sorpresas.
            </p>

            <h2 class="mt-20"><strong>Pruébalo gratis por 30 días</strong></h2>

            <p class="mt-6">
                Después, paga solo <strong>$79 MXN al año</strong>. <strong>Cancela cuando quieras</strong>, sin letras chiquitas ni cargos ocultos.
            </p>

            <h2 class="mt-20">Resuelve tus dudas</h2>

            <ul class="mt-6">
                <li>
                    <h3 class="font-medium text-zinc-950 text-base">¿Te preocupa la entregabilidad?</h3>
                    <p class="mt-4 text-base">Terrific Poll utiliza enlaces limpios y seguros, compatibles con todos los proveedores de correo. No hay archivos adjuntos ni redirecciones sospechosas.</p>
                </li>
                <li class="mt-6">
                    <h3 class="font-medium text-zinc-950 text-base">¿Te inquieta la privacidad?</h3>
                    <p class="mt-4 text-base">Tus datos y los de tu audiencia están cifrados y protegidos. Cumplimos con GDPR y nunca compartimos tu información.</p>
                </li>
                <li class="mt-6">
                    <h3 class="font-medium text-zinc-950 text-base">¿Quieres personalizar la experiencia?</h3>
                    <p class="mt-4 text-base">La página de confirmación es neutra y sin marcas visibles. El foco siempre está en tu pregunta.</p>
                </li>
                <li class="mt-6">
                    <h3 class="font-medium text-zinc-950 text-base">¿Tu plataforma no soporta merge tags?</h3>
                    <p class="mt-4 text-base">No pasa nada: tus lectores pueden ingresar su correo manualmente. Siempre tendrás una solución.</p>
                </li>
                <li class="mt-6">
                    <h3 class="font-medium text-zinc-950 text-base">¿Temes votos duplicados?</h3>
                    <p class="mt-4 text-base">El sistema detecta posibles repeticiones y te muestra los detalles para que tomes decisiones informadas.</p>
                </li>
                <li class="mt-6">
                    <h3 class="font-medium text-zinc-950 text-base">¿Necesitas exportar tus resultados?</h3>
                    <p class="mt-4 text-base">Descarga todo en CSV, cuando quieras. Tus datos son tuyos.</p>
                </li>
                <li class="mt-6">
                    <h3 class="font-medium text-zinc-950 text-base">¿Buscas soporte rápido?</h3>
                    <p class="mt-4 text-base">Resolvemos la mayoría de las dudas en menos de un día hábil, por correo o chat.</p>
                </li>
                <li class="mt-6">
                    <h3 class="font-medium text-zinc-950 text-base">¿Te preocupa la accesibilidad?</h3>
                    <p class="mt-4 text-base">Las encuestas y páginas cumplen con los estándares modernos para que todos puedan participar.</p>
                </li>
                <li class="mt-6">
                    <h3 class="font-medium text-zinc-950 text-base">¿No quieres compromisos?</h3>
                    <p class="mt-4 text-base">Disfruta 30 días gratis y cancela en cualquier momento. Sin riesgos, sin presiones.</p>
                </li>
            </ul>

            <flux:card class="max-w-lg mx-auto mt-20">
                <h2 class="text-2xl font-medium tracking-tight text-zinc-950 text-center mt-2"><strong>Convierte tu próxima newsletter en una conversación</strong></h2>
                <p class="text-center mt-4">Crea tu encuesta <strong class="font-medium text-zinc-950">gratis</strong> con Terrific Poll.</p>
                <ul class="mt-9 gap-3 md:grid md:grid-cols-2 md:gap-6 text-sm">
                    <li class="flex gap-2">
                        <flux:icon.check-circle variant="mini" class="text-green-500" />
                        Compatible con +8 plataformas populares de newsletters
                    </li>
                    <li class="flex gap-2">
                        <flux:icon.check-circle variant="mini" class="text-green-500" />
                        Hasta 10 opciones de respuesta por encuesta
                    </li>
                    <li class="flex gap-2">
                        <flux:icon.check-circle variant="mini" class="text-green-500" />
                        Resultados en tiempo real y exportables en CSV
                    </li>
                    <li class="flex gap-2">
                        <flux:icon.check-circle variant="mini" class="text-green-500" />
                        Más de 95% de entregabilidad reportada por usuarios
                    </li>
                    <li class="flex gap-2">
                        <flux:icon.check-circle variant="mini" class="text-green-500" />
                        Soporte en menos de 24 horas hábiles
                    </li>
                    <li class="flex gap-2">
                        <flux:icon.check-circle variant="mini" class="text-green-500" />
                        $79 MXN al año después de la prueba gratuita
                    </li>
                </ul>
                <flux:button :href="route('register')" variant="primary" color="amber" class="mt-9 w-full text-base!">
                    Empieza ahora — <strong>30 días gratis</strong>
                </flux:button>
            </flux:card>

            <p class="mt-20">
                ¿Listo para <strong>escuchar a tu audiencia</strong>? <strong>Regístrate</strong>, <strong>crea tu encuesta</strong> y <strong>obtén respuestas hoy mismo</strong>—incluso si tu plataforma nunca ha soportado encuestas.
            </p>

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
