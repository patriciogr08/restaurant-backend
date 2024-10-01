<?php

namespace Database\Seeders;

use App\Http\BusinessLogic\PerfilBusinessLogic;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PerfilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $perfiles =[
            [
                'codigo'            => "PERF-ADMIN",
                'nombre'            => "Administrador",
                'descripcion'       => "Perfil de administrador del sistema",
                'idUsuarioCreacion' => 1
            ],
            [
                'codigo'            => "PERF-CAJERO",
                'nombre'            => "Cajero",
                'descripcion'       => "Perfil de empleado del sistema",
                'idUsuarioCreacion' => 1
            ],
            [
                'codigo'            => "PERF-COCINERO",
                'nombre'            => "Cocinero",
                'descripcion'       => "Perfil del empleado del sistema",
                'idUsuarioCreacion' => 1
            ],
            [
                'codigo'            => "PERF-MESERO",
                'nombre'            => "Mesero",
                'descripcion'       => "Perfil del empleado del sistema",
                'idUsuarioCreacion' => 1
            ],
        ];

        $perfilBusinessLogic = new PerfilBusinessLogic();
        $contadores = [
            'perfilesCreados'       => 0,
            'perfilesActualizados'  => 0,
        ];

        $perfilBusinessLogic->crearActualizar($perfiles, $contadores);

        $this->command->info( "Perfiles creados: " . $contadores['perfilesCreados'] );
        $this->command->info( "Perfiles actualizados: " . $contadores['perfilesActualizados'] );

    }
}
