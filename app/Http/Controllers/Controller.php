<?php

namespace App\Http\Controllers;

use OpenApi\Attributes as OA;

#[OA\Info(
    version: '1.0.0',
    title: 'Polar Productos API',
    description: 'API para la gestión de productos, clientes, rutas, precios y descuentos de Polar.',
    contact: new OA\Contact(email: 'soporte@polar.com')
)]
#[OA\Server(url: '/api', description: 'API Server')]
#[OA\SecurityScheme(
    securityScheme: 'sanctum',
    type: 'apiKey',
    in: 'header',
    name: 'Authorization',
    description: 'Ingresa el token con el prefijo Bearer. Ejemplo: Bearer {token}'
)]
#[OA\Tag(name: 'Auth', description: 'Autenticación (Login, Logout, Perfil)')]
#[OA\Tag(name: 'Usuarios', description: 'Gestión de usuarios y roles')]
#[OA\Tag(name: 'Clientes', description: 'Clientes y datos relacionados')]
#[OA\Tag(name: 'Productos', description: 'Productos, unidades de producto y unidades de medida')]
#[OA\Tag(name: 'Rutas', description: 'Rutas, logins, datos generales, tipos de activo y jornadas')]
#[OA\Tag(name: 'Precios', description: 'Precios, productos de precio, impuestos y clasificaciones fiscales')]
#[OA\Tag(name: 'Descuentos', description: 'Descuentos, detalles y rutas de descuento')]
abstract class Controller
{
    //
}
