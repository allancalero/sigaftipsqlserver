<?php

use function Livewire\Volt\with;
use App\Models\Responsable;

with(fn () => [
    'responsables' => Responsable::paginate(10)
]);

?>

<div class="p-4 sm:p-6 lg:p-8">
    <flux:breadcrumbs>
        <flux:breadcrumbs.item href="{{ route('dashboard') }}" wire:navigate>Inicio</flux:breadcrumbs.item>
        <flux:breadcrumbs.item>Listado de Responsable</flux:breadcrumbs.item>
    </flux:breadcrumbs>

    <div class="mt-6 flow-root">
        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                    <div class="p-6 bg-white rounded-lg shadow-md dark:bg-zinc-800">
                        <h2 class="text-2xl font-bold mb-4 text-zinc-900 dark:text-zinc-100">Responsables</h2>

                        <div class="mb-4 flex justify-between items-center">
                            <input type="text" wire:model="search" placeholder="Buscar responsable..." class="px-4 py-2 border rounded-md focus:outline-none focus:ring dark:bg-zinc-700 dark:text-zinc-100" />
                        </div>

                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white dark:bg-zinc-900 rounded-lg">
                                <thead>
                                    <tr>
                                        <th class="px-4 py-2 border-b text-left text-sm font-semibold text-zinc-700 dark:text-zinc-200">ID</th>
                                        <th class="px-4 py-2 border-b text-left text-sm font-semibold text-zinc-700 dark:text-zinc-200">Nombre</th>
                                                    <th class="px-4 py-2 border-b text-left text-sm font-semibold text-zinc-700 dark:text-zinc-200">Cargo</th>
                                        <th class="px-4 py-2 border-b text-left text-sm font-semibold text-zinc-700 dark:text-zinc-200">Email</th>
                                        <th class="px-4 py-2 border-b text-left text-sm font-semibold text-zinc-700 dark:text-zinc-200">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($responsables as $responsable)
                                        <tr class="hover:bg-zinc-100 dark:hover:bg-zinc-700">
                                            <td class="px-4 py-2 border-b">{{ $responsable->id }}</td>
                                            <td class="px-4 py-2 border-b">{{ $responsable->nombre }}</td>
                                            <td class="px-4 py-2 border-b">{{ $responsable->cargo }}</td>
                                            <td class="px-4 py-2 border-b">{{ $responsable->email }}</td>
                                            <td class="px-4 py-2 border-b">
                                                <button class="px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700">Ver</button>
                                                <button class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600">Editar</button>
                                                <button class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700">Eliminar</button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="px-4 py-2 text-center text-zinc-500">No hay responsables registrados.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-4">
                            {{ $responsables->links() }}
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>
