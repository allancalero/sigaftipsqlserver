<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-white dark:bg-zinc-800" x-data="{ showLogoutModal: false }" @keydown.escape.window="showLogoutModal = false">
        <flux:sidebar sticky stashable collapsible="mobile" class="border-e border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
            <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

            <a href="{{ route('dashboard') }}" class="me-5 flex items-center space-x-2 rtl:space-x-reverse" wire:navigate>
                <x-app-logo />
            </a>
            <flux:navlist variant="outline">
                <flux:navlist.item icon="home"
                                   :href="route('dashboard')"
                                   :current="request()->routeIs('dashboard')"
                                   wire:navigate>{{ __('Inicio') }}
                </flux:navlist.item>

                
                <flux:navlist.group heading="Gestión de activos Fijo" collapsible class="mt-2">

                    <flux:navlist.item icon="tag"
                                       href="#"
                                       :current="false"
                                       wire:navigate>{{ __('Clasificación de activo') }}
                    </flux:navlist.item>
                    <flux:navlist.item icon="computer-desktop"
                                       href="#"
                                       :current="false"
                                       wire:navigate>{{ __('Registro Activo') }}
                    </flux:navlist.item>
                    <flux:navlist.item icon="arrow-path-rounded-square"
                                       href="#"
                                       :current="false"
                                       wire:navigate>{{ __('Reasignación de Activo') }}
                    </flux:navlist.item>
                     <flux:navlist.item icon="arrow-down-on-square-stack"
                                       href="#"
                                       :current="false"
                                       wire:navigate>{{ __('Baja Activo') }}
                    </flux:navlist.item>


                </flux:navlist.group>

                <flux:navlist.group heading="Catálogos" collapsible>
                    <flux:navlist.item icon="building-office"
                                       href="#"
                                       :current="false"
                                       wire:navigate>{{ __('Unidades Ejecutoras') }}
                    </flux:navlist.item>

                    <flux:navlist.item icon="credit-card"
                                       href="#"
                                       :current="false"
                                       wire:navigate>{{ __('Fuente de Financiamiento') }}
                    </flux:navlist.item>

                    <flux:navlist.item  icon="user-circle"
                                        :href="route('Responsables')"
                                        :current="request()->routeIs('dashboard')"
                                         wire:navigate>{{ __('Responsable') }}
                    </flux:navlist.item>

                    <flux:navlist.item icon="truck"
                                       href="#"
                                       :current="false"
                                       wire:navigate>{{ __('Proveedor') }}
                    </flux:navlist.item>

                </flux:navlist.group>

                <flux:navlist.group heading="Reportes" collapsible>
                    <flux:navlist.item icon="chart-bar"
                                       href="#"
                                       :current="false"
                                       wire:navigate>{{ __('Reportes') }}
                    </flux:navlist.item>
                </flux:navlist.group>

                 <flux:navlist.group heading="Sistema" collapsible>

                 <flux:navlist.item icon="shield-check"
                                       href="#"
                                       :current="false"
                                       wire:navigate>{{ __('Seguridad y roles') }}
                    </flux:navlist.item>

                    <flux:navlist.item icon="inbox-stack"
                                       href="#"
                                       :current="false"
                                       wire:navigate>{{ __('Copia Seguridad') }}
                    </flux:navlist.item> --}}
                    
                 </flux:navlist.group>
                
            </flux:navlist>

        </flux:sidebar>

        <flux:header class="border-b border-zinc-200 bg-zinc-50/50 backdrop-blur-md dark:border-zinc-700 dark:bg-zinc-900/50">
            <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />
            <flux:spacer />

            <flux:dropdown position="top" align="end">
                <flux:profile
                    class="max-lg:hidden"
                    :name="auth()->user()->name"
                    :initials="auth()->user()->initials()"
                    icon:trailing="chevrons-up-down"
                />
                <flux:profile
                    class="lg:hidden"
                    :initials="auth()->user()->initials()"
                    icon-trailing="chevron-down"
                />

                <flux:menu class="w-[220px]">
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                                <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                    <span
                                        class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white"
                                    >
                                        {{ auth()->user()->initials() }}
                                    </span>
                                </span>

                                <div class="grid flex-1 text-start text-sm leading-tight">
                                    <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                    <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <flux:menu.radio.group>
                        <flux:menu.item :href="route('profile.edit')" icon="cog" wire:navigate>{{ __('Configuración') }}</flux:menu.item>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <flux:menu.item
                        as="button"
                        type="button"
                        icon="arrow-right-start-on-rectangle"
                        @click="showLogoutModal = true"
                    >
                        {{ __('Cerrar Sesión') }}
                    </flux:menu.item>
                </flux:menu>
            </flux:dropdown>
        </flux:header>

        {{ $slot }}

        @fluxScripts

        <!-- Modal de Confirmación de Cierre de Sesión -->
        <div
            x-show="showLogoutModal"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
            style="display: none;"
        >
            <div @click.away="showLogoutModal = false" class="w-full max-w-md rounded-lg bg-white p-6 shadow-lg dark:bg-zinc-800">
                <h2 class="text-lg font-semibold text-zinc-900 dark:text-zinc-100">Confirmar Cierre de Sesión</h2>
                <p class="mt-2 text-sm text-zinc-600 dark:text-zinc-400">¿Estás seguro de que quieres cerrar tu sesión?</p>
                <div class="mt-6 flex justify-end space-x-4">
                    <button @click="showLogoutModal = false" type="button" class="rounded-md bg-zinc-200 px-4 py-2 text-sm font-medium text-zinc-800 hover:bg-zinc-300 dark:bg-zinc-700 dark:text-zinc-200 dark:hover:bg-zinc-600">
                        Cancelar
                    </button>
                    <button @click="document.getElementById('logout-form').submit()" type="button" class="rounded-md bg-red-600 px-4 py-2 text-sm font-medium text-white hover:bg-red-700">
                        Cerrar Sesión
                    </button>
                </div>
            </div>
        </div>

        <form id="logout-form" method="POST" action="{{ route('logout') }}" class="hidden">
            @csrf
        </form>
    </body>
</html> 
