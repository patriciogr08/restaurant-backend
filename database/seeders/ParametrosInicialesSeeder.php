<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ParametrosInicialesSeeder
{
    public function __invoke( )
    {
        return [
            'codigo'            => "PAR-TIPO-PROD",
            'nombre'            => "Tipos de Producto",
            'descripcion'       => "Listado de los tipos de productos que se pueden registrar en el sistema",
            'children'          => [
                [
                    "codigo"            => "TIPO-PROD-GENE",
                    "nombre"            => "General",
                    "descripcion"       => null,
                    "valor"             => null
                ],
                [
                    "codigo"            => "TIPO-PROD-BEBIDA",
                    "nombre"            => "Bebidas",
                    "descripcion"       => null,
                    "valor"             => null
                ],
                [
                    "codigo"            => "TIPO-PROD-CEVICHE",
                    "nombre"            => "Ceviches",
                    "descripcion"       => null,
                    "valor"             => null
                ],
                [
                    "codigo"            => "TIPO-PROD-ARROZ",
                    "nombre"            => "Arroces",
                    "descripcion"       => null,
                    "valor"             => null
                ],
                [
                    "codigo"            => "TIPO-PROD-SOPA",
                    "nombre"            => "Sopas",
                    "descripcion"       => null,
                    "valor"             => null
                ],
            ]
        ];
    }
}
