<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Producto extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Tabla asociada al modelo.
     *
     * @var string
     */
    protected $table = 'productos';

        /**
     * Los atributos que son asignables en masa.
     *
     * @var array
     */
    protected $fillable = [
        'idTipoProducto',
        'codigo',
        'nombre',
        'precio',
        'iva',
        'idUsuarioCreacion',
    ];

    protected $appends = ['precioConIva'];


    /**
     * Relación con el modelo User (creador del producto).
     */
    public function usuarioCreacion()
    {
        return $this->belongsTo(User::class, 'idUsuarioCreacion');
    }

    /**
     * Relación con el modelo Parametro (tipo de producto).
     */
    public function tipoProducto()
    {
        return $this->belongsTo(Parametro::class, 'idTipoProducto');
    }

    /**
     * Obtener el valor del IVA desde la tabla parametros.
     */
    public function obtenerValorIva()
    {
        $parametroIva = Parametro::where('codigo', 'PAR-IVA')->first();
        return $parametroIva ? ( (float)$parametroIva->valor/100 ) : 0.12; // Valor por defecto del 12% si no se encuentra
    }

    /**
     * Obtener el precio del producto con IVA incluido.
     */
    public function getPrecioConIvaAttribute()
    {
        return $this->iva ? $this->precio * (1 + $this->obtenerValorIva()) : $this->precio;
    }
}
