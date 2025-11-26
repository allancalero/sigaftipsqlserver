<?php

namespace App\Livewire;

use App\Models\Asignacion;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Asignacions extends Component
{
    use WithPagination, WithFileUploads;

    protected $paginationTheme = 'tailwind';

    // campos del formulario
    public $nombre, $apellido, $cargo, $telefono, $email, $numero_empleado, $estado, $foto;

    public $showCreateForm = false;

    public $showModal = false;
    public $asignacionSeleccionada = null;


    //Reglasde validacion
    protected $rules = [
        'nombre' => 'required|string|max:55',
        'apellido' => 'required|string|max:55',
        'cargo' => 'required|string|max:55',
        'telefono' => 'required|string|max:9',
        'email' => 'required|email|unique:asignacions,email',
        'numero_empleado' => 'required|string|unique:asignacions,numero_empleado',
        'estado' => 'required|in:ACTIVO,INACTIVO',
        'foto' => 'nullable|image|max:2048',
    ];
    
    //resetear campos del formulario
    public function resetInputFields()
    {
        $this->nombre = '';
        $this->apellido = '';
        $this->cargo = '';
        $this->telefono = '';
        $this->email = '';
        $this->numero_empleado = '';
        $this->estado = '';
        $this->foto = null;
    }   

    public function openCreateForm()
    {
        $this->resetInputFields();
        $this->resetValidation();
        $this->showCreateForm = true;
    }

    public function hideCreateForm()
    {
        $this->showCreateForm = false;
    }

    //guardar asignacion
    public function save()
    {
        $this->validate();

        $fotoPath = null;
        if ($this->foto) {
            $fotoPath = $this->foto->store('fotos', 'public');
        }
        
        Asignacion::create([
            'nombre' => $this->nombre,
            'apellido' => $this->apellido,
            'cargo' => $this->cargo,
            'telefono' => $this->telefono,
            'email' => $this->email,
            'numero_empleado' => $this->numero_empleado,
            'estado' => $this->estado,
            'foto' => $fotoPath,
        ]);

        session()->flash('message', 'Empleado creado exitosamente.');

        $this->resetInputFields();
        $this->hideCreateForm();
    }


    public function show($id)
    {
        $this->asignacionSeleccionada = Asignacion::find($id);
        $this->showModal = (bool) $this->asignacionSeleccionada;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->asignacionSeleccionada = null;
    }

     public function render()
    {
       // Paginar por 20 registros
        $asignacions = Asignacion::paginate(10  );

        return view('livewire.asignacions', compact('asignacions'));
    }
}
