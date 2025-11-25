<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-white antialiased dark:bg-linear-to-b dark:from-neutral-950 dark:to-neutral-900">
        <div class="relative grid h-dvh flex-col items-center justify-center px-8 sm:px-0 lg:max-w-none lg:grid-cols-2 lg:px-0">
            <div class="bg-muted relative hidden h-full flex-col p-10 text-white lg:flex dark:border-e dark:border-neutral-800">
                <!-- Imagen de fondo -->
                <div class="absolute inset-0 bg-neutral-900 bg-cover bg-center" 
                     style="background-image: url('{{ asset('images/tipitapa-bg.jpg') }}');">
                    <!-- Overlay oscuro para mejorar legibilidad -->
                    <div class="absolute inset-0 bg-neutral-900/80"></div>
                </div>
                
                <a href="{{ route('home') }}" class="relative z-20 flex items-center text-lg font-medium" wire:navigate>
                    <span class="flex h-10 w-10 items-center justify-center rounded-md">
                        <!-- Logo de la Alcaldía -->
                        <img src="{{ asset('images/logo-alcaldia.png') }}" 
                             alt="Alcaldía de Tipitapa" 
                             class="h-8 w-auto">
                    </span>
                    Alcaldía de Tipitapa
                </a>

                <div class="relative z-20 mt-auto">
                    <blockquote class="space-y-2">
                        <flux:heading size="lg">&ldquo;Sistema de información web para el control de activos fijos en la alcaldía de Tipitapa.&rdquo;</flux:heading>
                        <footer><flux:heading>Alcaldia de Tipitapa</flux:heading></footer>
                    </blockquote>
                </div>
            </div>
            <div class="w-full lg:p-8">
                <div class="mx-auto flex w-full flex-col justify-center space-y-6 sm:w-[350px]">
                    <a href="{{ route('home') }}" class="z-20 flex flex-col items-center gap-2 font-medium lg:hidden" wire:navigate>
                        <span class="flex h-9 w-9 items-center justify-center rounded-md">
                            <!-- Logo para versión móvil -->
                            <img src="{{ asset('images/logo-alcaldia.png') }}" 
                                 alt="Alcaldía de Tipitapa" 
                                 class="h-8 w-auto">
                        </span>
                        <span class="sr-only">Alcaldía de Tipitapa</span>
                    </a>
                    {{ $slot }}
                </div>
            </div>
        </div>
        @fluxScripts
    </body>
</html>
