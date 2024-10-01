<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Perfil extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'perfiles';

    protected $fillable = [
        'codigo',
        'nombre',
        'descripcion',
        'idUsuarioCreacion',
    ];

    /**
     * Relación Uno a Varios
     */
    public function usuarios() {
        return $this->hasMany(User::class, 'idPerfil');
    }

}
