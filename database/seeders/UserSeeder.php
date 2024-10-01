<?php

namespace Database\Seeders;

use App\Models\Perfil;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
    }
}
