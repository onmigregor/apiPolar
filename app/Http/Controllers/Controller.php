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
// ═══════════════════════════════════════════════
//  1. CARGAS MASIVAS (Prioridad Polar)
// ═══════════════════════════════════════════════
#[OA\Tag(name: 'Cargas Masivas - MasterCustomer', description: 'Carga masiva de datos maestros de clientes')]
#[OA\Tag(name: 'Cargas Masivas - MasterProduct', description: 'Carga masiva de datos maestros de productos')]
#[OA\Tag(name: 'Cargas Masivas - MasterPromotion', description: 'Carga masiva de datos maestros de promociones')]
// #[OA\Tag(name: 'Cargas Masivas - MasterDiscount', description: 'Carga masiva de datos maestros de descuentos')]

// ═══════════════════════════════════════════════
//  2. OPERACIONES INDIVIDUALES (CRUD)
// ═══════════════════════════════════════════════
// --- Auth & Usuarios ---
#[OA\Tag(name: 'Auth', description: 'Autenticación (Login, Logout, Perfil)')]
#[OA\Tag(name: 'Usuarios', description: 'Gestión de usuarios y roles')]
// --- Clientes ---
#[OA\Tag(name: 'Clientes - Customer', description: 'CRUD de clientes')]
#[OA\Tag(name: 'Clientes - City', description: 'Ciudades')]
#[OA\Tag(name: 'Clientes - CustomerGroup', description: 'Grupos de clientes')]
#[OA\Tag(name: 'Clientes - CustomerBranch', description: 'Ramos de clientes')]
#[OA\Tag(name: 'Clientes - CustomerRegion', description: 'Regiones de clientes')]
#[OA\Tag(name: 'Clientes - CustomerFrequency', description: 'Frecuencias de visita')]
#[OA\Tag(name: 'Clientes - CustomerRoute', description: 'Rutas de clientes')]
#[OA\Tag(name: 'Clientes - CustomerInfo', description: 'Información adicional de clientes')]
#[OA\Tag(name: 'Clientes - CustomerPrice', description: 'Precios de clientes')]
#[OA\Tag(name: 'Clientes - InfoType', description: 'Tipos de información (licencias)')]
// --- Productos ---
#[OA\Tag(name: 'Productos - Product', description: 'Productos')]
#[OA\Tag(name: 'Productos - ProductUnit', description: 'Unidades de producto')]
#[OA\Tag(name: 'Productos - Unit', description: 'Unidades de medida')]
#[OA\Tag(name: 'Productos - ProductFamily', description: 'Familias de producto - Clasificación Nivel 1')]
#[OA\Tag(name: 'Productos - ProductCategory', description: 'Categorías de producto - Clasificación Nivel 2')]
// --- Rutas ---
#[OA\Tag(name: 'Rutas - Route', description: 'Rutas')]
#[OA\Tag(name: 'Rutas - RouteLogin', description: 'Logins de ruta')]
#[OA\Tag(name: 'Rutas - RouteGeneral', description: 'Datos generales de ruta')]
#[OA\Tag(name: 'Rutas - RouteAssetType', description: 'Tipos de activo')]
#[OA\Tag(name: 'Rutas - Journey', description: 'Jornadas')]
// --- Precios ---
#[OA\Tag(name: 'Precios - Price', description: 'Listas de precios')]
#[OA\Tag(name: 'Precios - PriceProduct', description: 'Productos de precio')]
#[OA\Tag(name: 'Precios - Tax', description: 'Impuestos')]
#[OA\Tag(name: 'Precios - Taxation', description: 'Clasificaciones fiscales')]
#[OA\Tag(name: 'Precios - TaxationTax', description: 'Impuestos por clasificación')]
// --- Descuentos ---
#[OA\Tag(name: 'Descuentos - Discount', description: 'Descuentos')]
#[OA\Tag(name: 'Descuentos - DiscountDetail', description: 'Detalles de descuento')]
#[OA\Tag(name: 'Descuentos - DiscountDetailProduct', description: 'Productos de detalle')]
#[OA\Tag(name: 'Descuentos - DiscountDetailRoute', description: 'Rutas de detalle')]

abstract class Controller
{
    //
}
