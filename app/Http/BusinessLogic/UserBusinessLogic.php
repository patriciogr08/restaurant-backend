<?php

namespace App\Http\BusinessLogic;

use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Hash;
use Throwable;

class UserBusinessLogic {

    public function __construct(){
    }

    public function index() {
        try {
            return User::with('perfil')->get();
        } catch ( Throwable $ex){
            throw new Exception('Error'.$ex->getMessage().' Clase: '.class_basename($this));        
        }
    }

    public function show($id) {
        try {
            $user = User::findOrfail($id);
            $user->perfil;
            return $user;
        } catch (ModelNotFoundException $ex) {
            throw new ModelNotFoundException( "Error: ".$ex->getMessage().". Clase: ".class_basename($this) );
        } catch (Throwable $ex) {
            throw new Exception('Error: ' . $ex->getMessage() . ' Clase: ' . class_basename($this));       
        }
    }

    public function store($request) {
        try {
            $user = new User();
            $data = $request->all();
            if (isset($data['password'])) {
                $data['password'] = Hash::make($data['password']);
            }
            $user->fill($data);
            $user->save();
            return $user;
        } catch ( Throwable $ex) {
            throw new Exception('Error: ' . $ex->getMessage() . ' Clase: ' . class_basename($this));
        }
    }

    public function update($request, $id) {
        try {
            $user = User::findOrfail($id);
            $user->fill($request->all());
            $user->save();
            return $user;
        } catch (ModelNotFoundException $ex) {
            throw new ModelNotFoundException("Error: " . $ex->getMessage() . ". Clase: " . class_basename($this));
        } catch (Throwable $ex) {
            throw new Exception('Error: ' . $ex->getMessage() . ' Clase: ' . class_basename($this));
        }
    }

    public function destroy($id) {
        try {
            $user = User::findOrfail($id);
            $user->delete();
            return $user;
        } catch (ModelNotFoundException $ex) {
            throw new ModelNotFoundException("Error: " . $ex->getMessage() . ". Clase: " . class_basename($this));
        } catch (Throwable $ex) {
            throw new Exception('Error: ' . $ex->getMessage() . ' Clase: ' . class_basename($this));
        }
    }

    public function restore(int $id){
        try {
            $user = User::withTrashed()->findOrFail($id);
            $user->restore();
            return $user;
        } catch (ModelNotFoundException $ex) {
            throw new ModelNotFoundException("Error: " . $ex->getMessage() . ". Clase: " . class_basename($this));
        } catch (Throwable $ex) {
            throw new Exception('Error: ' . $ex->getMessage() . ' Clase: ' . class_basename($this));
        }
    }

    public function all(){
        try {
            $usuarios = User::withTrashed()->with('perfil')->get();
        } catch (Throwable $ex) {
            throw new Exception('Error'.$ex->getMessage().' Clase: '.class_basename($this));        
        }

        return $usuarios;
    }
    
}