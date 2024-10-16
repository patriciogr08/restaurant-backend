<?php

namespace Database\Seeders;

use App\Http\BusinessLogic\ParametroBusinessLogic;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ParametrosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
                //
        $parametroBusinessLogic = new ParametroBusinessLogic();

        $rows = [];
        $rows[] = (new ParametrosInicialesSeeder)();
        $rows[] = (new ParametroIva)();


        $contador = [
            'parametrosCreados'         => 0,
            'parametrosActualizados'    => 0,
        ];

        $parametroBusinessLogic->crearActualizarParametrosRecursivo($rows, $contador);

        $this->command->info('Total parametros creados: ' . $contador['parametrosCreados']);
        $this->command->info('Total parametros actualizados: ' . $contador['parametrosActualizados']);
    }
}
