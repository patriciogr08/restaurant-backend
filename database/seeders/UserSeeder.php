<?php

namespace Database\Seeders;

use App\Models\Perfil;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userUpdate =  [
            'username'    => "admin",
            'email'       => "admin@gmail.com"
        ];

        $perfil = Perfil::where('codigo', 'PERF-ADMIN')->first();
        if( $perfil ) {
            $userUpdate['idPerfil'] = $perfil->id;
            $user = User::where('username', $userUpdate['username'])->first();
            if ( $user) {
                $user->fill($userUpdate);
                if ($user->isDirty()) {
                    $user->save();

                    $this->command->info( "Usuario actualizado: " . $userUpdate['username'] );
                }
            }
        }

        $admin = User::where('username', 'admin')->first();
        if ($admin) {
            $adminRole = Role::where('name', 'admin')->first();
            if ($adminRole) {
            $admin->assignRole($adminRole);
            $this->command->info("Rol 'admin' asignado al usuario: " . $admin->username);
            } else {
            $this->command->error("Rol 'admin' no encontrado.");
            }
        }

    }
}
