<?php

namespace App\Http\Controllers;

use App\Http\BusinessLogic\PerfilBusinessLogic;
use App\Http\Requests\CreatePerfil;
use App\Http\Requests\UpdatePerfil;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PerfilController extends Controller
{
    //
    private $perfilBusinessLogic;

    public function __construct() {
        $this->perfilBusinessLogic = new PerfilBusinessLogic();
    }

    public function index() {
        $status     = Response::HTTP_OK;
        $message    = 'Perfiles obtenidos correctamente';
        $data =  $this->perfilBusinessLogic->index();

        return response_success($data, $status, $message);

    }

    public function show($id) {
        try {
            $status     = Response::HTTP_OK;
            $message    = 'Perfil obtenido correctamente';
            $data =  $this->perfilBusinessLogic->show($id);
    
        }  catch (ModelNotFoundException $ex) {
            $status = Response::HTTP_NOT_FOUND;
            $message = "Perfil no encontrado";
            return response_error($status, $message);

        } catch (\Throwable $th) {
            $status = Response::HTTP_BAD_REQUEST;
            $message = "Ocurrió un error al obtener el perfil";
            return response_error($status, $message);
        }

        return response_success($data, $status, $message);
    }

    public function store( CreatePerfil $request){
        try {

            $data =  $this->perfilBusinessLogic->store($request);
        } catch (\Throwable $ex) {
            $status = Response::HTTP_BAD_REQUEST;
            $message = "Ocurrió un error al crear el perfil";
            return response_error($status, $message);
        }

        $status     = Response::HTTP_CREATED;
        $message    = 'Perfil creado correctamente';
        return response_success($data, $status, $message);

    }

    public function update( UpdatePerfil $request, $id){
        try {

            $data =  $this->perfilBusinessLogic->update($request, $id);

        }  catch (ModelNotFoundException $ex) {
            $status = Response::HTTP_NOT_FOUND;
            $message = "Perfil no encontrado";
            return response_error($status, $message);
        } catch (\Throwable $ex) {
            $status = Response::HTTP_BAD_REQUEST;
            $message = "Ocurrió un error al actualizar el Perfil";
            return response_error($status, $message);
        }

        $status     = Response::HTTP_OK;
        $message    = 'Perfil actualizado correctamente';
        return response_success($data, $status, $message);
    }

    public function destroy($id){
        try {
            $data =  $this->perfilBusinessLogic->destroy($id);
        } catch (ModelNotFoundException $ex) {
            $status = Response::HTTP_NOT_FOUND;
            $message = "Perfil no encontrado";
            return response_error($status, $message);
        } catch (\Throwable $ex) {
            $status = Response::HTTP_BAD_REQUEST;
            $message = "Ocurrió un error al eliminar el perfil";
            return response_error($status, $message);
        }

        $status     = Response::HTTP_OK;
        $message    = 'Perfil eliminado correctamente';
        return response_success($data, $status, $message);
    }

    public function all(){
        try {
            $data =  $this->perfilBusinessLogic->all();
        } catch (\Throwable $ex) {
            $status = Response::HTTP_BAD_REQUEST;
            $message = "Ocurrió un error al obtener los perfiles";
            return response_error($status, $message);
        }
        $status     = Response::HTTP_OK;
        $message    = 'Perfiles obtenidos correctamente';
        return response_success($data, $status, $message);
    }

    public function restore($id){
        try {
            $data =  $this->perfilBusinessLogic->restore($id);
        } catch (ModelNotFoundException $ex) {
            $status = Response::HTTP_NOT_FOUND;
            $message = "Perfil no encontrado";
            return response_error($status, $message);
        } catch (\Throwable $ex) {
            $status = Response::HTTP_BAD_REQUEST;
            $message = "Ocurrió un error al restaurar el perfil";
            return response_error($status, $message);
        }

        $status     = Response::HTTP_OK;
        $message    = 'Perfil restaurado correctamente';
        return response_success($data, $status, $message);
    }
    
}
