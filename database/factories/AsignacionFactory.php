<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Asignacion>
 */
class AsignacionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->firstName(),
            'apellido' => $this->faker->lastName(),
            'cargo' => $this->faker->jobTitle(),
            'telefono' => $this->faker->phoneNumber(),
            'email' => $this->faker->unique()->safeEmail(),
            'numero_empleado' => $this->faker->unique()->numerify('EMP####'),
            'estado' => $this->faker->randomElement(['ACTIVO', 'INACTIVO']),
            'foto' => null,
        ];
    }
}
