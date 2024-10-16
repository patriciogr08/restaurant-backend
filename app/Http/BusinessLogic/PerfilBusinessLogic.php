<?php

namespace App\Http\BusinessLogic;

use App\Models\Perfil;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Throwable;

class PerfilBusinessLogic {

    public function __construct(){
    }

    public function index(){
        try {
            return Perfil::all();
        } catch (Throwable $ex) {
            throw new Exception('Error'.$ex->getMessage().' Clase: '.class_basename($this));        
        }
    }

    public function show($id){
        try {
            return Perfil::findOrFail($id);
        } catch (ModelNotFoundException $ex) {
            throw new ModelNotFoundException( "Error: ".$ex->getMessage().". Clase: ".class_basename($this) );
        } catch (Throwable $ex) {
            throw new Exception('Error: ' . $ex->getMessage() . ' Clase: ' . class_basename($this));       
        }
       
    }

    public function store($request){
        try {
            $data = $request->all();
            $data['idUsuarioCreacion'] = Auth::user()->id;
            
            $perfil = Perfil::create($data);
            return $perfil;
        } catch ( Throwable $ex) {
            throw new Exception('Error: ' . $ex->getMessage() . ' Clase: ' . class_basename($this));
        }

        
    }

    public function update($request, $id){
      
        try {
            $perfil = Perfil::findOrFail($id);
            $perfil->fill($request->all());
            $perfil->save();

            return $perfil;
        } catch (ModelNotFoundException $ex) {
            throw new ModelNotFoundException("Error: " . $ex->getMessage() . ". Clase: " . class_basename($this));
        } catch (Throwable $ex) {
            throw new Exception('Error: ' . $ex->getMessage() . ' Clase: ' . class_basename($this));
        }

    }

    public function destroy($id){
        try {
            $perfil = Perfil::findOrFail($id);
            $perfil->delete();
            return $perfil;
        } catch (ModelNotFoundException $ex) {
            throw new ModelNotFoundException("Error: " . $ex->getMessage() . ". Clase: " . class_basename($this));
        } catch (Throwable $ex) {
            throw new Exception('Error: ' . $ex->getMessage() . ' Clase: ' . class_basename($this));
        }
    }

    public function restore(int $id){
        try {
            $perfil = Perfil::onlyTrashed()->findOrFail($id);
            $perfil->restore();
            return $perfil;
        } catch (ModelNotFoundException $ex) {
            throw new ModelNotFoundException("Error: " . $ex->getMessage() . ". Clase: " . class_basename($this));
        } catch (Throwable $ex) {
            throw new Exception('Error: ' . $ex->getMessage() . ' Clase: ' . class_basename($this));
        }
    }


    public function all(){
        try {
            return Perfil::withTrashed()->get();
        } catch (Throwable $ex) {
            throw new Exception('Error'.$ex->getMessage().' Clase: '.class_basename($this));        
        }
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