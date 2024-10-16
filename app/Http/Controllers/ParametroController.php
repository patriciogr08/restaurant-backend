<?php

namespace App\Http\Controllers;

use App\Http\BusinessLogic\ParametroBusinessLogic;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ParametroController extends Controller
{
    private $parametroBusinessLogic;

    public function __construct() {
        $this->parametroBusinessLogic = new ParametroBusinessLogic();
    }

    public function getList( $codigo ) {
        try {
            $data =  $this->parametroBusinessLogic->getChildren($codigo);

        } catch (\Throwable $ex) {
            $status = Response::HTTP_BAD_REQUEST;
            $message = "Ocurrio un error al obtener el listado de parametros";
            return response_error($status, $message);
        }

        $status     = Response::HTTP_OK;
        $message    = 'Parametros mostrados correctamente';
        return response_success($data, $status, $message);
    }
}
