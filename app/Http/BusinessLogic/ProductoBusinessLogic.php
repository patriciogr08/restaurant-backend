<?php

namespace App\Http\BusinessLogic;

use App\Models\Producto;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Exception;

class ProductoBusinessLogic
{
    /**
     * Obtener todos los productos.
     *
     * @return Collection
     */
    public function index(): Collection
    {
       try {
            return Producto::with('tipoProducto')->get();
       } catch (\Throwable $ex) {
         throw new Exception('Error'.$ex->getMessage().' Clase: '.class_basename($this));        
       }
    }

    /**
     * Obtener un producto por su ID.
     *
     * @param int $id
     * @return Producto|null
     */
    public function show(int $id): ?Producto
    {
        try {
            return Producto::with('tipoProducto')->findOrfail($id);
        } catch (ModelNotFoundException $ex) {
            throw new ModelNotFoundException("Error: " . $ex->getMessage() . ". Clase: " . class_basename($this));
        } catch (\Throwable $ex) {
            throw new Exception('Error: ' . $ex->getMessage() . ' Clase: ' . class_basename($this));
        }
    }

    /**
     * Crear un nuevo producto.
     *
     * @param array $data
     * @return Producto
     */
    public function store( $request ): Producto
    {
        try {
            $data = $request->all();
            $data['idUsuarioCreacion'] = Auth::user()->id;
            $data['iva'] = true;

            return Producto::create($data);
        } catch (\Throwable $ex) {
            throw new Exception('Error: ' . $ex->getMessage() . ' Clase: ' . class_basename($this));
        }
    }

    /**
     * Actualizar un producto existente.
     *
     * @param int $id
     * @param array $data
     * @return Producto|null
     */
    public function update(int $id, $request): ?Producto
    {
        try {
            $producto = Producto::findOrfail($id);
            $producto->fill($request->all());
            $producto->save();

            return $producto;
        } catch (ModelNotFoundException $ex) {
            throw new ModelNotFoundException("Error: " . $ex->getMessage() . ". Clase: " . class_basename($this));
        } catch (\Throwable $ex) {
            throw new Exception('Error: ' . $ex->getMessage() . ' Clase: ' . class_basename($this));       
        }
    }

    /**
     * Eliminar un producto (soft delete).
     *
     * @param int $id
     * @return bool
     */
    public function destroy(int $id): bool
    {
        try {
            $producto = Producto::findOrfail($id);

            return $producto->delete();;
        } catch (ModelNotFoundException $ex) {
            throw new ModelNotFoundException("Error: " . $ex->getMessage() . ". Clase: " . class_basename($this));
        } catch (\Throwable $ex) {
            throw new Exception('Error: ' . $ex->getMessage() . ' Clase: ' . class_basename($this));
        }
    }

    /**
     * Restaurar un producto eliminado.
     *
     * @param int $id
     * @return bool
     */
    public function restore(int $id): Producto
    {
        try {
            $producto = Producto::withTrashed()->findOrFail($id);
            $producto->restore();
            return $producto;
        } catch (ModelNotFoundException $ex) {
            throw new ModelNotFoundException("Error: " . $ex->getMessage() . ". Clase: " . class_basename($this));
        } catch (\Throwable $ex) {
            throw new Exception('Error: ' . $ex->getMessage() . ' Clase: ' . class_basename($this));
        }
    }

    /**
     * Obtener todos los productos eliminados.
     *
     * @return Collection
     */
    public function all(): Collection
    {
        try {
            return Producto::withTrashed()->get();
        } catch (\Throwable $ex) {
            throw new Exception('Error'.$ex->getMessage().' Clase: '.class_basename($this));        
        }
    }

    /**
     * Búsqueda de productos por nombre con paginación.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function search($request)
    {
        try {
            $busqueda = $request->input('search', 'A');
            return Producto::where('nombre', 'LIKE', '%' . $busqueda . '%')
                ->paginate(20);

        } catch (\Throwable $ex) {
            throw new Exception('Error: ' . $ex->getMessage() . ' Clase: ' . class_basename($this));
        }
    }
}
