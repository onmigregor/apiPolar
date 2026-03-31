<?php

namespace App\Swagger;

use OpenApi\Attributes as OA;

class DescuentosSwagger
{
    // --- DISCOUNTS ---
    #[OA\Get(path: '/discounts', summary: 'Listar descuentos (paginado)', tags: ['Descuentos - Discount'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'per_page', in: 'query', required: false, schema: new OA\Schema(type: 'integer', default: 15))],
        responses: [new OA\Response(response: 200, description: 'Lista de descuentos')]
    )]
    public function listDiscounts() {}

    #[OA\Post(path: '/discounts', summary: 'Crear descuento', tags: ['Descuentos - Discount'],
        security: [['sanctum' => []]],
        requestBody: new OA\RequestBody(required: true, content: new OA\JsonContent(
            required: ['dis_code', 'dis_name'],
            properties: [
                new OA\Property(property: 'dis_code', type: 'string', maxLength: 4),
                new OA\Property(property: 'dis_name', type: 'string', maxLength: 20),
            ]
        )),
        responses: [new OA\Response(response: 201, description: 'Descuento creado')]
    )]
    public function storeDiscount() {}

    #[OA\Get(path: '/discounts/{id}', summary: 'Obtener descuento', tags: ['Descuentos - Discount'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))],
        responses: [new OA\Response(response: 200, description: 'Detalle')]
    )]
    public function showDiscount() {}

    #[OA\Put(path: '/discounts/{id}', summary: 'Actualizar descuento', tags: ['Descuentos - Discount'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))],
        requestBody: new OA\RequestBody(required: true, content: new OA\JsonContent(properties: [
            new OA\Property(property: 'dis_code', type: 'string', maxLength: 4),
            new OA\Property(property: 'dis_name', type: 'string', maxLength: 20),
        ])),
        responses: [new OA\Response(response: 200, description: 'Descuento actualizado')]
    )]
    public function updateDiscount() {}

    #[OA\Delete(path: '/discounts/{id}', summary: 'Eliminar descuento', tags: ['Descuentos - Discount'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))],
        responses: [new OA\Response(response: 200, description: 'Descuento eliminado')]
    )]
    public function deleteDiscount() {}

    // --- DISCOUNT DETAILS ---
    #[OA\Get(path: '/discount_details', summary: 'Listar detalles de descuento', tags: ['Descuentos - DiscountDetail'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'per_page', in: 'query', required: false, schema: new OA\Schema(type: 'integer', default: 15))],
        responses: [new OA\Response(response: 200, description: 'Lista')]
    )]
    public function listDiscountDetails() {}

    #[OA\Post(path: '/discount_details', summary: 'Crear detalle de descuento', tags: ['Descuentos - DiscountDetail'],
        security: [['sanctum' => []]],
        requestBody: new OA\RequestBody(required: true, content: new OA\JsonContent(
            required: ['dis_code', 'did_code', 'did_name'],
            properties: [
                new OA\Property(property: 'dis_code', type: 'string', maxLength: 4),
                new OA\Property(property: 'did_code', type: 'string', maxLength: 10),
                new OA\Property(property: 'did_name', type: 'string', maxLength: 20),
                new OA\Property(property: 'rot_code_customer', type: 'string', maxLength: 6),
                new OA\Property(property: 'cus_code', type: 'string', maxLength: 10),
                new OA\Property(property: 'did_since', type: 'string', format: 'date'),
                new OA\Property(property: 'did_until', type: 'string', format: 'date'),
            ]
        )),
        responses: [new OA\Response(response: 201, description: 'Detalle creado')]
    )]
    public function storeDiscountDetail() {}

    #[OA\Get(path: '/discount_details/{id}', summary: 'Obtener detalle', tags: ['Descuentos - DiscountDetail'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))],
        responses: [new OA\Response(response: 200, description: 'Detalle')]
    )]
    public function showDiscountDetail() {}

    #[OA\Put(path: '/discount_details/{id}', summary: 'Actualizar detalle', tags: ['Descuentos - DiscountDetail'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))],
        requestBody: new OA\RequestBody(required: true, content: new OA\JsonContent(properties: [
            new OA\Property(property: 'dis_code', type: 'string', maxLength: 4),
            new OA\Property(property: 'did_code', type: 'string', maxLength: 10),
            new OA\Property(property: 'did_name', type: 'string', maxLength: 20),
        ])),
        responses: [new OA\Response(response: 200, description: 'Detalle actualizado')]
    )]
    public function updateDiscountDetail() {}

    #[OA\Delete(path: '/discount_details/{id}', summary: 'Eliminar detalle', tags: ['Descuentos - DiscountDetail'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))],
        responses: [new OA\Response(response: 200, description: 'Detalle eliminado')]
    )]
    public function deleteDiscountDetail() {}

    // --- DISCOUNT DETAIL PRODUCTS ---
    #[OA\Get(path: '/discount_detail_products', summary: 'Listar productos de detalle de descuento', tags: ['Descuentos - DiscountDetailProduct'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'per_page', in: 'query', required: false, schema: new OA\Schema(type: 'integer', default: 15))],
        responses: [new OA\Response(response: 200, description: 'Lista')]
    )]
    public function listDiscountDetailProducts() {}

    #[OA\Post(path: '/discount_detail_products', summary: 'Crear producto de detalle', tags: ['Descuentos - DiscountDetailProduct'],
        security: [['sanctum' => []]],
        requestBody: new OA\RequestBody(required: true, content: new OA\JsonContent(
            required: ['dlp_code', 'dis_code', 'did_code', 'pro_code', 'unt_code'],
            properties: [
                new OA\Property(property: 'dlp_code', type: 'string', maxLength: 10),
                new OA\Property(property: 'dis_code', type: 'string', maxLength: 4),
                new OA\Property(property: 'did_code', type: 'string', maxLength: 10),
                new OA\Property(property: 'pro_code', type: 'string', maxLength: 18),
                new OA\Property(property: 'unt_code', type: 'string', maxLength: 3),
                new OA\Property(property: 'dlp_discount', type: 'number', format: 'float'),
            ]
        )),
        responses: [new OA\Response(response: 201, description: 'Producto creado')]
    )]
    public function storeDiscountDetailProduct() {}

    #[OA\Get(path: '/discount_detail_products/{id}', summary: 'Obtener producto de detalle', tags: ['Descuentos - DiscountDetailProduct'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))],
        responses: [new OA\Response(response: 200, description: 'Detalle')]
    )]
    public function showDiscountDetailProduct() {}

    #[OA\Put(path: '/discount_detail_products/{id}', summary: 'Actualizar producto de detalle', tags: ['Descuentos - DiscountDetailProduct'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))],
        requestBody: new OA\RequestBody(required: true, content: new OA\JsonContent(properties: [
            new OA\Property(property: 'dlp_code', type: 'string', maxLength: 10),
            new OA\Property(property: 'dis_code', type: 'string', maxLength: 4),
            new OA\Property(property: 'did_code', type: 'string', maxLength: 10),
        ])),
        responses: [new OA\Response(response: 200, description: 'Producto actualizado')]
    )]
    public function updateDiscountDetailProduct() {}

    #[OA\Delete(path: '/discount_detail_products/{id}', summary: 'Eliminar producto de detalle', tags: ['Descuentos - DiscountDetailProduct'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))],
        responses: [new OA\Response(response: 200, description: 'Producto eliminado')]
    )]
    public function deleteDiscountDetailProduct() {}

    // --- DISCOUNT DETAIL ROUTES ---
    #[OA\Get(path: '/discount_detail_routes', summary: 'Listar rutas de detalle de descuento', tags: ['Descuentos - DiscountDetailRoute'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'per_page', in: 'query', required: false, schema: new OA\Schema(type: 'integer', default: 15))],
        responses: [new OA\Response(response: 200, description: 'Lista')]
    )]
    public function listDiscountDetailRoutes() {}

    #[OA\Post(path: '/discount_detail_routes', summary: 'Crear ruta de detalle', tags: ['Descuentos - DiscountDetailRoute'],
        security: [['sanctum' => []]],
        requestBody: new OA\RequestBody(required: true, content: new OA\JsonContent(
            required: ['rot_code', 'dis_code'],
            properties: [
                new OA\Property(property: 'rot_code', type: 'string', maxLength: 6),
                new OA\Property(property: 'dis_code', type: 'string', maxLength: 4),
            ]
        )),
        responses: [new OA\Response(response: 201, description: 'Ruta creada')]
    )]
    public function storeDiscountDetailRoute() {}

    #[OA\Get(path: '/discount_detail_routes/{id}', summary: 'Obtener ruta de detalle', tags: ['Descuentos - DiscountDetailRoute'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))],
        responses: [new OA\Response(response: 200, description: 'Detalle')]
    )]
    public function showDiscountDetailRoute() {}

    #[OA\Put(path: '/discount_detail_routes/{id}', summary: 'Actualizar ruta de detalle', tags: ['Descuentos - DiscountDetailRoute'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))],
        requestBody: new OA\RequestBody(required: true, content: new OA\JsonContent(properties: [
            new OA\Property(property: 'rot_code', type: 'string', maxLength: 6),
            new OA\Property(property: 'dis_code', type: 'string', maxLength: 4),
        ])),
        responses: [new OA\Response(response: 200, description: 'Ruta actualizada')]
    )]
    public function updateDiscountDetailRoute() {}

    #[OA\Delete(path: '/discount_detail_routes/{id}', summary: 'Eliminar ruta de detalle', tags: ['Descuentos - DiscountDetailRoute'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))],
        responses: [new OA\Response(response: 200, description: 'Ruta eliminada')]
    )]
    public function deleteDiscountDetailRoute() {}

    // ═══════════════════════════════════════════════
    //  MASTER DISCOUNT (bulk)
    // ═══════════════════════════════════════════════
/*
    #[OA\Post(path: '/masterdiscount', summary: 'Carga masiva de datos maestros de descuento', tags: ['Cargas Masivas - MasterDiscount'],
        security: [['sanctum' => []]],
        requestBody: new OA\RequestBody(required: true, content: new OA\JsonContent(
            type: 'array',
            items: new OA\Items(type: 'object', properties: [
                new OA\Property(property: 'Descuento', type: 'object', properties: [
                    new OA\Property(property: 'disCode', type: 'string', maxLength: 4),
                    new OA\Property(property: 'disName', type: 'string', maxLength: 20),
                ]),
                new OA\Property(property: 'detalleDescuento', type: 'object', properties: [
                    new OA\Property(property: 'disCode', type: 'string', maxLength: 4),
                    new OA\Property(property: 'didCode', type: 'string', maxLength: 10),
                    new OA\Property(property: 'didName', type: 'string', maxLength: 20),
                    new OA\Property(property: 'rotCodeCustomer', type: 'string', maxLength: 6),
                    new OA\Property(property: 'cusCode', type: 'string', maxLength: 10),
                    new OA\Property(property: 'didSince', type: 'string', format: 'date'),
                    new OA\Property(property: 'didUntil', type: 'string', format: 'date'),
                ]),
                new OA\Property(property: 'productoDescuento', type: 'object', properties: [
                    new OA\Property(property: 'dlpCode', type: 'string', maxLength: 10),
                    new OA\Property(property: 'disCode', type: 'string', maxLength: 4),
                    new OA\Property(property: 'didCode', type: 'string', maxLength: 10),
                    new OA\Property(property: 'proCode', type: 'string', maxLength: 18),
                    new OA\Property(property: 'untCode', type: 'string', maxLength: 3),
                    new OA\Property(property: 'dlpDiscount', type: 'number', format: 'float'),
                    new OA\Property(property: 'dlpDiscountPercentage', type: 'number', format: 'float'),
                    new OA\Property(property: 'dlpDiscountAmount', type: 'number', format: 'float'),
                ]),
                new OA\Property(property: 'rutaDescuento', type: 'object', properties: [
                    new OA\Property(property: 'rotCode', type: 'string', maxLength: 6),
                    new OA\Property(property: 'disCode', type: 'string', maxLength: 4),
                ]),
            ])
        )),
        responses: [
            new OA\Response(response: 201, description: 'Registros creados exitosamente'),
            new OA\Response(response: 500, description: 'Error en la carga masiva'),
        ]
    )]
    public function masterDiscount() {}
*/
}
