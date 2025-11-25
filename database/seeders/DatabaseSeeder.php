<?php

namespace Database\Seeders;

use App\Models\Asignacion; 
use App\Models\User;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;



class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Asignacion::factory(10)->create();

            $admin = User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Administrador',
                'password' => Hash::make('Password123'),
            ],
        );
        
            $admin->forceFill(['email_verified_at' => now()])->save();
    
}
    }
