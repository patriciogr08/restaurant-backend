<?php

namespace App\Http\BusinessLogic;

use App\Models\Perfil;

class PerfilBusinessLogic {

    public function __construct(){
    }
    

    public function crearActualizar( $perfiles , &$contador){
        if (is_array($perfiles)) {
            foreach ($perfiles as $perfil) {
                $perfilModel = Perfil::where('codigo', $perfil['codigo'])->first();
                if ($perfilModel) {
                    $perfilModel->fill([
                        'nombre'      => $perfil['nombre'],
                        'descripcion' => $perfil['descripcion'],
                    ]);

                    if ($perfilModel->isDirty()) {
                        $perfilModel->save();
                        $contador['perfilesActualizados']++;
                    }
                } else {
                    $perfilModel = Perfil::create([
                        'codigo'            => $perfil['codigo'],
                        'nombre'            => $perfil['nombre'],
                        'descripcion'       => $perfil['descripcion'],
                        'idUsuarioCreacion' => getIdUsuarioAdmin(),
                    ]);
                    $contador['perfilesCreados']++;
                }
            }
        }
    }
}