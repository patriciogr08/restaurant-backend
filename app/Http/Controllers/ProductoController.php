<?php

namespace App\Http\Controllers;

use App\Http\BusinessLogic\ProductoBusinessLogic;
use App\Http\Requests\CreateProducto;
use App\Http\Requests\UpdateProducto;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductoController extends Controller
{
    private $productoBusinessLogic;

    public function __construct(){
        $this->productoBusinessLogic = new ProductoBusinessLogic();
    }

    public function index(){
        try {
            $data =  $this->productoBusinessLogic->index();

        } catch (\Throwable $ex) {
            $status = Response::HTTP_BAD_REQUEST;
            $message = "Ocurrió un error al obtener los productos activos";
            return response_error($status, $message);
        }

        $status     = Response::HTTP_OK;
        $message    = 'Productos obtenidos correctamente';

        return response_success($data, $status, $message);
    }

    public function show($id){
        try {
            $status     = Response::HTTP_OK;
            $message    = 'Producto obtenido correctamente';
            $data =  $this->productoBusinessLogic->show($id);
    

        }  catch (ModelNotFoundException $ex) {
            $status = Response::HTTP_NOT_FOUND;
            $message = "Producto no encontrado";
            return response_error($status, $message);

        } catch (\Throwable $th) {
            $status = Response::HTTP_BAD_REQUEST;
            $message = "Ocurrió un error al obtener el producto";
            return response_error($status, $message);
        }
        
        return response_success($data, $status, $message);

    }

    public function store( CreateProducto $request){
        try {
            $data = $this->productoBusinessLogic->store( $request );
        } catch (\Throwable $ex) {
            $status = Response::HTTP_BAD_REQUEST;
            $message = "Ocurrió un error al crear el producto";
            return response_error($status, $message);
        }

        $status     = Response::HTTP_CREATED;
        $message    = 'Producto creado correctamente';

        return response_success($data, $status, $message);
    }
    
    public function update( UpdateProducto $request ,$id ){
        try {
        
            $data = $this->productoBusinessLogic->update( $id , $request );
        
        } catch (ModelNotFoundException $ex) {
            $status = Response::HTTP_NOT_FOUND;
            $message = "Producto no encontrado";
            return response_error($status, $message);

        } catch (\Throwable $th) {
            $status = Response::HTTP_BAD_REQUEST;
            $message = "Ocurrió un error al actualizar el Producto";
            return response_error($status, $message);
        }

        $status     = Response::HTTP_OK;
        $message    = 'Producto actualizado correctamente';

        return response_success($data, $status, $message);

    }

    public function destroy(int $id ){
        try {
            $data =  $this->productoBusinessLogic->destroy($id);
    
        } catch (ModelNotFoundException $ex) {
            $status = Response::HTTP_NOT_FOUND;
            $message = "Producto no encontrado";
            return response_error($status, $message);

        } catch (\Throwable $ex) {
            $status = Response::HTTP_BAD_REQUEST;
            $message = $ex->getMessage();"Ocurrió un error al eliminar el Producto";
            return response_error($status, $message);
        }

        $status     = Response::HTTP_OK;
        $message    = 'Producto eliminado correctamente';

        return response_success($data, $status, $message);
    }

    public function restore( $id ){
        try {
            $data =  $this->productoBusinessLogic->restore($id);
    
        } catch (ModelNotFoundException $ex) {
            $status = Response::HTTP_NOT_FOUND;
            $message = "Producto no encontrado";
            return response_error($status, $message);

        } catch (\Throwable $th) {
            $status = Response::HTTP_BAD_REQUEST;
            $message = "Ocurrió un error al restaurar el Producto";
            return response_error($status, $message);
        }

        $status     = Response::HTTP_OK;
        $message    = 'Producto restaurando correctamente';

        return response_success($data, $status, $message);
    }

    public function all(){
        try {
            $data =  $this->productoBusinessLogic->all();
    
        } catch (\Throwable $th) {
            $status = Response::HTTP_BAD_REQUEST;
            $message = "Ocurrió un error al obtener todos los productos";
            return response_error($status, $message);
        }

        $status     = Response::HTTP_OK;
        $message    = 'Productos obtenidos correctamente';

        return response_success($data, $status, $message);
    }

    public function search( Request $request){
        try {
            $data =  $this->productoBusinessLogic->search($request);
    
        } catch (\Throwable $th) {
            $status = Response::HTTP_BAD_REQUEST;
            $message = "Ocurrió un error al obtener los productos buscados";
            return response_error($status, $message);
        }

        $status     = Response::HTTP_OK;
        $message    = 'Productos obtenidos correctamente';

        return response_success($data, $status, $message);
    }


}
