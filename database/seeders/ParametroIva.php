<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ParametroIva
{
    public function __invoke( )
    {
        return [
            "codigo"            => "PAR-IVA",
            "nombre"            => "IVA (Impuesto al Valor Agregado)",
            "descripcion"       => "Porcentaje de IVA a aplicar a los productos",
            "valor"             => 12,
            "children"          => []
        ];
    }
}
