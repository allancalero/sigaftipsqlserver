<div>
            <flux:breadcrumbs>
                    <flux:breadcrumbs.item href="{{ route('dashboard') }}">Inicio</flux:breadcrumbs.item>
                    <flux:breadcrumbs.item href="{{ route('asignacions') }}">Listado de Asignaciones</flux:breadcrumbs.item>
            </flux:breadcrumbs>
            {{-- Close your eyes. Count to one. That is how long forever feels. --}}

<br>
<hr>
<br>
            <div class="overflow-x-auto">
                <table class ="min-w-full bg-black border-b divide-y divide-gray-200" style="width: 100%">
                <thead class="border-b bg-gray-50 dark:bg-gray-700 dark:text-white">
                <th class="py-3 px-4" style=background-color:#f0f0f0>Id</th>
                <th class="py-3 px-4" style=background-color:#f0f0f0>Nombre</th>
                <th class="py-3 px-4" style=background-color:#f0f0f0>Apellido</th>
                <th class="py-3 px-4" style=background-color:#f0f0f0>Cargo</th>
                <th class="py-3 px-4" style=background-color:#f0f0f0>Telefono</th>
                <th class="py-3 px-4" style=background-color:#f0f0f0>Email</th>
                <th class="py-3 px-4" style=background-color:#f0f0f0># Empleado</th>
                <th class="py-3 px-4" style=background-color:#f0f0f0>Foto</th>
                <th class="py-3 px-4" style=background-color:#f0f0f0>Estado</th>
                <th class="py-3 px-4" style=background-color:#f0f0f0>Acciones</th>
                </thead>
     

            <tbody style="border: 1px solid # f0f0f0;">
                @foreach ($asignacions as $asignacion)
                <tr style="border: 1px solid # f0f0f0;">
                    <td class="py-3 px-4 " style=text- lign="center" >{{ $asignacion->id }}</td>
                    <td>{{ $asignacion->nombre }}</td>
                    <td>{{ $asignacion->apellido }}</td>
                    <td>{{ $asignacion->cargo }}</td>
                    <td>{{ $asignacion->telefono }}</td>
                    <td>{{ $asignacion->email }}</td>
                    <td>{{ $asignacion->numero_empleado }}</td>
                    <td>
                        @if($asignacion->foto)
                            <img src="{{ asset('storage/fotos/'.$asignacion->foto) }}" alt="Foto de {{ $asignacion->nombre }}" width="50">
                        @else
                            <span>—</span>
                        @endif
                    </td>      
                    <td>{{ $asignacion->estado }}</td>

                    <td>


                    </td>
                </tr>
                    
                @endforeach


            </tbody>
       </table>

       <div class="mt-4">
           {{ $asignacions->links() }}
       </div>
</div>
 </div>
