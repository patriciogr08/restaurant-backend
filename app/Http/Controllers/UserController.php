<?php

namespace App\Http\Controllers;

use App\Http\BusinessLogic\UserBusinessLogic;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    //

    private $userBusinessLogic;

    public function __construct() {
        $this->userBusinessLogic = new UserBusinessLogic();
    }

    public function index() {
        $status     = Response::HTTP_OK;
        $message    = 'Usuarios obtenidos correctamente';
        $data =  $this->userBusinessLogic->index();

        return response_success($data, $status, $message);

    }

    public function show($id) {
        try {
            $status     = Response::HTTP_OK;
            $message    = 'Usuario obtenido correctamente';
            $data =  $this->userBusinessLogic->show($id);
    
        }  catch (ModelNotFoundException $ex) {
            $status = Response::HTTP_NOT_FOUND;
            $message = "Usuario no encontrado";
            return response_error($status, $message);

        } catch (\Throwable $th) {
            $status = Response::HTTP_BAD_REQUEST;
            $message = "Ocurrió un error al obtener el usuario";
            return response_error($status, $message);
        }

        return response_success($data, $status, $message);
    }

    public function store( CreateUserRequest $request){
        try {
          
            $data =  $this->userBusinessLogic->store($request);
    
        } catch (\Throwable $ex) {
            $status = Response::HTTP_BAD_REQUEST;
            $message = $ex->getMessage();//"Ocurrió un error al crear el usuario";
            return response_error($status, $message);
        }

        $status     = Response::HTTP_CREATED;
        $message    = 'Usuario creado correctamente';

        return response_success($data, $status, $message);
    }

    public function update(UpdateUserRequest $request, $id) {
        try {
            $data =  $this->userBusinessLogic->update($request, $id);
    
        } catch (ModelNotFoundException $ex) {
            $status = Response::HTTP_NOT_FOUND;
            $message = "Usuario no encontrado";
            return response_error($status, $message);

        } catch (\Throwable $th) {
            $status = Response::HTTP_BAD_REQUEST;
            $message = "Ocurrió un error al actualizar el usuario";
            return response_error($status, $message);
        }

        $status     = Response::HTTP_OK;
        $message    = 'Usuario actualizado correctamente';

        return response_success($data, $status, $message);
    }

    public function destroy($id) {
        try {
            $data =  $this->userBusinessLogic->destroy($id);
    
        } catch (ModelNotFoundException $ex) {
            $status = Response::HTTP_NOT_FOUND;
            $message = "Usuario no encontrado";
            return response_error($status, $message);

        } catch (\Throwable $th) {
            $status = Response::HTTP_BAD_REQUEST;
            $message = "Ocurrió un error al eliminar el usuario";
            return response_error($status, $message);
        }

        $status     = Response::HTTP_OK;
        $message    = 'Usuario eliminado correctamente';

        return response_success($data, $status, $message);
    }
}

