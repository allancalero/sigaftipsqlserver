<div class="space-y-6 py-4">
    <flux:breadcrumbs>
        <flux:breadcrumbs.item href="{{ route('dashboard') }}">Inicio</flux:breadcrumbs.item>
        <flux:breadcrumbs.item href="{{ route('asignacions') }}">Listado del personal asignado</flux:breadcrumbs.item>
    </flux:breadcrumbs>

    <div class="flex items-center justify-between">
        <div>
            <flux:heading size="xl">Personal asignado</flux:heading>
            <flux:text class="mt-1">Gestiona el personal y registra nuevas asignaciones.</flux:text>
        </div>

        <flux:button variant="primary" wire:click="openCreateForm">Agregar personal</flux:button>
    </div>

    @if (session()->has('message'))
        <div class="rounded-lg border border-green-200 bg-green-50 p-4 text-sm text-green-800">
            {{ session('message') }}
        </div>
    @endif

    @if ($showCreateForm)
        <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm dark:border-zinc-700 dark:bg-zinc-900">
            <div class="flex items-start justify-between">
                <div>
                    <flux:heading size="lg">Nueva asignación</flux:heading>
                    <flux:text class="mt-1">Completa los datos del colaborador y guarda la asignación.</flux:text>
                </div>

                <flux:button variant="ghost" size="sm" wire:click="hideCreateForm">Cerrar</flux:button>
            </div>

            <form wire:submit.prevent="save" class="mt-6 space-y-4">
                <div class="grid gap-4 sm:grid-cols-2">
                    <flux:input wire:model.defer="nombre" label="Nombre" type="text" required />
                    <flux:input wire:model.defer="apellido" label="Apellido" type="text" required />
                    <flux:input wire:model.defer="cargo" label="Cargo" type="text" required />
                    <flux:input wire:model.defer="telefono" label="Teléfono" type="text" required />
                    <flux:input wire:model.defer="email" label="Email" type="email" required />
                    <flux:input wire:model.defer="numero_empleado" label="Número de empleado" type="text" required />
                    <flux:input wire:model.defer="estado" label="Estado" type="text" placeholder="ACTIVO / INACTIVO" required />

                    <div class="sm:col-span-2 space-y-2">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200" for="foto">
                            Foto del colaborador
                        </label>
                        <input
                            id="foto"
                            type="file"
                            wire:model="foto"
                            accept="image/*"
                            class="block w-full rounded border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:border-zinc-700 dark:bg-zinc-900 dark:text-zinc-100"
                        />

                        @error('foto')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror

                        @if ($foto)
                            <div class="mt-2 flex items-center gap-3">
                                <span class="text-xs text-gray-500 dark:text-gray-400">Previsualización:</span>
                                <img src="{{ $foto->temporaryUrl() }}" alt="Previsualización" class="h-16 w-16 rounded object-cover" />
                            </div>
                        @endif
                    </div>
                </div>

                <div class="flex justify-end gap-3">
                    <flux:button variant="ghost" type="button" wire:click="hideCreateForm" data-test="cancel-create-asignacion-button">
                        Cancelar
                    </flux:button>
                    <flux:button variant="primary" type="submit" data-test="create-asignacion-button">
                        Guardar
                    </flux:button>
                </div>
            </form>
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm dark:divide-zinc-700 dark:border-zinc-700 dark:bg-zinc-900">
            <thead class="bg-gray-50 text-left text-sm font-semibold uppercase tracking-wide text-gray-600 dark:bg-zinc-800 dark:text-zinc-200">
                <tr>
                    <th class="px-4 py-3">Id</th>
                    <th class="px-4 py-3">Nombre</th>
                    <th class="px-4 py-3">Apellido</th>
                    <th class="px-4 py-3">Cargo</th>
                    <th class="px-4 py-3">Teléfono</th>
                    <th class="px-4 py-3">Email</th>
                    <th class="px-4 py-3"># Empleado</th>
                    <th class="px-4 py-3">Foto</th>
                    <th class="px-4 py-3">Estado</th>
                    <th class="px-4 py-3">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 text-sm text-gray-700 dark:divide-zinc-800 dark:text-zinc-200">
                @foreach ($asignacions as $asignacion)
                    <tr>
                        <td class="px-4 py-3 text-center font-medium">{{ $asignacion->id }}</td>
                        <td class="px-4 py-3">{{ $asignacion->nombre }}</td>
                        <td class="px-4 py-3">{{ $asignacion->apellido }}</td>
                        <td class="px-4 py-3">{{ $asignacion->cargo }}</td>
                        <td class="px-4 py-3">{{ $asignacion->telefono }}</td>
                        <td class="px-4 py-3">{{ $asignacion->email }}</td>
                        <td class="px-4 py-3">{{ $asignacion->numero_empleado }}</td>
                        <td class="px-4 py-3">
                            @if ($asignacion->foto)
                                <img src="{{ asset('storage/'.$asignacion->foto) }}" alt="Foto de {{ $asignacion->nombre }}" class="h-12 w-12 rounded object-cover">
                            @else
                                <span>—</span>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            <span class="inline-flex items-center rounded-full bg-blue-50 px-2.5 py-0.5 text-xs font-semibold uppercase tracking-wide text-blue-700 dark:bg-blue-500/10 dark:text-blue-300">
                                {{ $asignacion->estado }}
                            </span>
                        </td>
                        <td class="px-4 py-3">
                            <flux:modal.trigger :name="'asignacion-'.$asignacion->id">
                                <flux:button size="sm" variant="primary" wire:click="show({{ $asignacion->id }})">Ver detalle</flux:button>
                            </flux:modal.trigger>

                            <flux:modal :name="'asignacion-'.$asignacion->id" class="md:w-96">
                                <div class="space-y-4">
                                    <div>
                                        <flux:heading size="lg">Asignación #{{ $asignacion->id }}</flux:heading>
                                        <flux:text class="mt-1">Información detallada del personal asignado.</flux:text>
                                    </div>

                                    <div class="space-y-2 text-sm">
                                        <flux:text><strong>Nombre:</strong> {{ $asignacion->nombre }} {{ $asignacion->apellido }}</flux:text>
                                        <flux:text><strong>Cargo:</strong> {{ $asignacion->cargo }}</flux:text>
                                        <flux:text><strong>Teléfono:</strong> {{ $asignacion->telefono }}</flux:text>
                                        <flux:text><strong>Email:</strong> {{ $asignacion->email }}</flux:text>
                                        <flux:text><strong>Número de empleado:</strong> {{ $asignacion->numero_empleado }}</flux:text>
                                        <flux:text><strong>Estado:</strong> {{ $asignacion->estado }}</flux:text>
                                    </div>

                                    @if ($asignacion->foto)
                                        <div class="flex justify-center">
                                            <img src="{{ asset('storage/'.$asignacion->foto) }}" alt="Foto de {{ $asignacion->nombre }}" class="h-28 w-28 rounded object-cover">
                                        </div>
                                    @endif

                                    <div class="flex justify-end gap-2">
                                        <flux:button variant="ghost" @click="$dispatch('modal-close', { name: 'asignacion-{{ $asignacion->id }}' })">
                                            Cerrar
                                        </flux:button>
                                    </div>
                                </div>
                            </flux:modal>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div>
        {{ $asignacions->links() }}
    </div>
</div>
