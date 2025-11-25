<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asignacion extends Model
{
    /** @use HasFactory<\Database\Factories\AsignacionFactory> */
    use HasFactory;

    protected $fillable = [
        'nombre',
        'apellido',
        'cargo',
        'telefono',
        'email',
        'numero_empleado',
        'estado',
        'foto',
    ];




}
