<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->setCommandTitle( 'PERFILES' );
        $this->call( PerfilSeeder::class );

        $this->setCommandTitle( 'PARAMETROS' );
        $this->call( ParametrosSeeder::class );

        $this->setCommandTitle( 'USUARIOS' );
        $this->call( UserSeeder::class );

    }




        private function setCommandTitle( $name ) {
            $this->command->info( "******************* IM $name SEEDER *******************" );
        }
}
