<?php

namespace App\Http\BusinessLogic;

use App\Models\Parametro;
use Exception;
use Illuminate\Support\Facades\Auth;

class ParametroBusinessLogic {

    public function __construct(){
    }

    public function getChildren($codigoPadre) {
        try {
            $parametroPadre = Parametro::where('codigo', $codigoPadre)->first();
            if ($parametroPadre) {
                return $parametroPadre->children;
            }
            return collect();
            
        } catch (\Throwable $ex) {
            throw new Exception('Error'.$ex->getMessage().' Clase: '.class_basename($this));

        }        
    }

    public function store( $request){
        try {
            $data = $request->all();
            $data['idUsuarioCreacion'] = Auth::user()->id;
            
            $parametro = Parametro::create( $data );
            return $parametro;
            
        } catch (\Throwable $ex) {
            throw new Exception('Error'.$ex->getMessage().' Clase: '.class_basename($this));

        }
    }

    public function crearActualizarParametrosRecursivo( $rows, &$contador,  $idPadre = null ){
        $idUsuarioCreacion = getIdUsuarioAdmin();

        if (is_array($rows)) {
            foreach ($rows as $row) {
                $parametro = Parametro::where('codigo', $row['codigo'])->first();
                if ($parametro) {
                    $parametro->fill([
                        'nombre'      => $row['nombre'],
                        'descripcion' => $row['descripcion'],
                        'valor'       => $row['valor'] ?? null,
                    ]);

                    if ($parametro->isDirty()) {
                        $parametro->save();
                        $contador['parametrosActualizados']++;
                    }
                } else {
                    $parametro = Parametro::create([
                    'codigo'            => $row['codigo'],
                    'nombre'            => $row['nombre'],
                    'descripcion'       => $row['descripcion'],
                    'idUsuarioCreacion' => $idUsuarioCreacion,
                    'valor'             => $row['valor'] ?? null,
                    'idPadre'           => $idPadre,
                    ]);
                    $contador['parametrosCreados']++;
                }
                if (isset($row['children'])) {
                    $this->crearActualizarParametrosRecursivo($row['children'], $contador, $idUsuarioCreacion, $parametro->id);
                }
            }
        }
    }   
}