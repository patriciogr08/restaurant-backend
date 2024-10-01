<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Parametro extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'codigo',
        'nombre',
        'descripcion',
        'idPadre',
        'idUsuarioCreacion',
        'valor',
    ];

    /**
    * Relación Uno a Varios ( inversa )
    */
    public function padre() {
        return $this->belongsTo(Parametro::class, 'idPadre');
    }
    

    public function usuarioCreacion() {
        return $this->belongsTo(User::class, 'idUsuarioCreacion');
    }


    public function children()
    {
        $select = [ 'id','codigo','nombre','descripcion','idPadre','valor' ];

        return $this->hasMany(Parametro::class, 'idPadre')
                ->select( $select )
                ->with(['children' => function ($query) use ($select){
                    $query->select( $select );
                }]);
    }
}
