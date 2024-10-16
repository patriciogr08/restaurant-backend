<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['name'        => 'admin']
        ]; 

        $this->crearRoles($roles);
        
    }


    private function crearRoles($roles, $modulo = 'Administrador') {
        $actualizados = 0; 
        $nuevos       = 0; 
        foreach($roles as $role) {
            $rol = Role::where('name', $role['name'] )->first();
            if( $rol ) {
                $rol = $rol->fill($role);
                if( $rol->isDirty() ) {
                    $rol->save();
                    $actualizados++;
                }
            } else {
                Role::create($role);
                $nuevos++;
            }
        }
        $this->command->info( "************* Módulo $modulo *******************" );
        $this->command->info( "Total roles creados: $nuevos" );
        $this->command->info( "Total roles actualizados: $actualizados " );
    }
}
