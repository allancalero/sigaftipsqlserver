<?php

namespace App\Livewire;

use App\Models\Asignacion;
use Livewire\Component;
use Livewire\WithPagination;

class Asignacions extends Component
{
    use WithPagination;
    
     protected $paginationTheme = 'tailwind';
    public function render()
    {
       // Paginar por 20 registros
        $asignacions = Asignacion::paginate(10  );

        return view('livewire.asignacions', compact('asignacions'));
    }
}
