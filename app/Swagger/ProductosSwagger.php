<?php

namespace App\Swagger;

use OpenApi\Attributes as OA;

class ProductosSwagger
{
    // --- PRODUCTS ---
    #[OA\Get(path: '/products', summary: 'Listar productos (paginado)', tags: ['Productos'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'per_page', in: 'query', required: false, schema: new OA\Schema(type: 'integer', default: 15))],
        responses: [new OA\Response(response: 200, description: 'Lista de productos')]
    )]
    public function listProducts() {}

    #[OA\Post(path: '/products', summary: 'Crear producto', tags: ['Productos'],
        security: [['sanctum' => []]],
        requestBody: new OA\RequestBody(required: true, content: new OA\JsonContent(
            required: ['pro_code', 'pro_name', 'pro_short_name'],
            properties: [
                new OA\Property(property: 'pro_code', type: 'string', maxLength: 18),
                new OA\Property(property: 'pro_name', type: 'string', maxLength: 40),
                new OA\Property(property: 'pro_short_name', type: 'string', maxLength: 40),
                new OA\Property(property: 'pro_organization', type: 'string', maxLength: 4),
                new OA\Property(property: 'unt_code', type: 'string', maxLength: 3),
                new OA\Property(property: 'pro_bom_code', type: 'string', maxLength: 18),
                new OA\Property(property: 'cl2_code', type: 'string', maxLength: 18),
                new OA\Property(property: 'pro_weight', type: 'number', format: 'float'),
            ]
        )),
        responses: [new OA\Response(response: 201, description: 'Producto creado'), new OA\Response(response: 422, description: 'Error de validación')]
    )]
    public function storeProduct() {}

    #[OA\Get(path: '/products/{id}', summary: 'Obtener producto', tags: ['Productos'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))],
        responses: [new OA\Response(response: 200, description: 'Detalle del producto')]
    )]
    public function showProduct() {}

    #[OA\Put(path: '/products/{id}', summary: 'Actualizar producto', tags: ['Productos'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))],
        requestBody: new OA\RequestBody(required: true, content: new OA\JsonContent(properties: [
            new OA\Property(property: 'pro_code', type: 'string', maxLength: 18),
            new OA\Property(property: 'pro_name', type: 'string', maxLength: 40),
        ])),
        responses: [new OA\Response(response: 200, description: 'Producto actualizado')]
    )]
    public function updateProduct() {}

    #[OA\Delete(path: '/products/{id}', summary: 'Eliminar producto', tags: ['Productos'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))],
        responses: [new OA\Response(response: 200, description: 'Producto eliminado')]
    )]
    public function deleteProduct() {}

    // --- PRODUCT UNITS ---
    #[OA\Get(path: '/product_units', summary: 'Listar unidades de producto', tags: ['Productos'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'per_page', in: 'query', required: false, schema: new OA\Schema(type: 'integer', default: 15))],
        responses: [new OA\Response(response: 200, description: 'Lista')]
    )]
    public function listProductUnits() {}

    #[OA\Post(path: '/product_units', summary: 'Crear unidad de producto', tags: ['Productos'],
        security: [['sanctum' => []]],
        requestBody: new OA\RequestBody(required: true, content: new OA\JsonContent(
            required: ['pro_code', 'unt_code', 'pru_divide_by'],
            properties: [
                new OA\Property(property: 'pro_code', type: 'string', maxLength: 18),
                new OA\Property(property: 'unt_code', type: 'string', maxLength: 3),
                new OA\Property(property: 'pru_divide_by', type: 'string', maxLength: 13),
            ]
        )),
        responses: [new OA\Response(response: 201, description: 'Unidad creada')]
    )]
    public function storeProductUnit() {}

    #[OA\Get(path: '/product_units/{id}', summary: 'Obtener unidad de producto', tags: ['Productos'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))],
        responses: [new OA\Response(response: 200, description: 'Detalle')]
    )]
    public function showProductUnit() {}

    #[OA\Put(path: '/product_units/{id}', summary: 'Actualizar unidad de producto', tags: ['Productos'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))],
        requestBody: new OA\RequestBody(required: true, content: new OA\JsonContent(properties: [
            new OA\Property(property: 'pro_code', type: 'string', maxLength: 18),
            new OA\Property(property: 'unt_code', type: 'string', maxLength: 3),
            new OA\Property(property: 'pru_divide_by', type: 'string', maxLength: 13),
        ])),
        responses: [new OA\Response(response: 200, description: 'Unidad actualizada')]
    )]
    public function updateProductUnit() {}

    #[OA\Delete(path: '/product_units/{id}', summary: 'Eliminar unidad de producto', tags: ['Productos'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))],
        responses: [new OA\Response(response: 200, description: 'Unidad eliminada')]
    )]
    public function deleteProductUnit() {}

    // --- UNITS ---
    #[OA\Get(path: '/units', summary: 'Listar unidades de medida', tags: ['Productos'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'per_page', in: 'query', required: false, schema: new OA\Schema(type: 'integer', default: 15))],
        responses: [new OA\Response(response: 200, description: 'Lista')]
    )]
    public function listUnits() {}

    #[OA\Post(path: '/units', summary: 'Crear unidad de medida', tags: ['Productos'],
        security: [['sanctum' => []]],
        requestBody: new OA\RequestBody(required: true, content: new OA\JsonContent(
            required: ['unt_code', 'unt_name', 'unt_nick'],
            properties: [
                new OA\Property(property: 'unt_code', type: 'string', maxLength: 3),
                new OA\Property(property: 'unt_name', type: 'string', maxLength: 10),
                new OA\Property(property: 'unt_nick', type: 'string', maxLength: 3),
            ]
        )),
        responses: [new OA\Response(response: 201, description: 'Unidad creada')]
    )]
    public function storeUnit() {}

    #[OA\Get(path: '/units/{id}', summary: 'Obtener unidad de medida', tags: ['Productos'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))],
        responses: [new OA\Response(response: 200, description: 'Detalle')]
    )]
    public function showUnit() {}

    #[OA\Put(path: '/units/{id}', summary: 'Actualizar unidad de medida', tags: ['Productos'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))],
        requestBody: new OA\RequestBody(required: true, content: new OA\JsonContent(properties: [
            new OA\Property(property: 'unt_code', type: 'string', maxLength: 3),
            new OA\Property(property: 'unt_name', type: 'string', maxLength: 10),
            new OA\Property(property: 'unt_nick', type: 'string', maxLength: 3),
        ])),
        responses: [new OA\Response(response: 200, description: 'Unidad actualizada')]
    )]
    public function updateUnit() {}

    #[OA\Delete(path: '/units/{id}', summary: 'Eliminar unidad de medida', tags: ['Productos'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))],
        responses: [new OA\Response(response: 200, description: 'Unidad eliminada')]
    )]
    public function deleteUnit() {}
}
