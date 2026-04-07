<?php

namespace App\Swagger;

use OpenApi\Attributes as OA;

class ProductosSwagger
{
    // --- PRODUCTS ---
    #[OA\Get(path: '/products', summary: 'Listar productos (paginado)', tags: ['Productos - Product'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'per_page', in: 'query', required: false, schema: new OA\Schema(type: 'integer', default: 15))],
        responses: [new OA\Response(response: 200, description: 'Lista de productos')]
    )]
    public function listProducts() {}

    #[OA\Post(path: '/products', summary: 'Crear producto', tags: ['Productos - Product'],
        security: [['sanctum' => []]],
        requestBody: new OA\RequestBody(required: true, content: new OA\JsonContent(
            required: ['pro_code', 'pro_name', 'pro_short_name'],
            properties: [
                new OA\Property(property: 'pro_code', type: 'string', maxLength: 18),
                new OA\Property(property: 'pro_name', type: 'string', maxLength: 40),
                new OA\Property(property: 'pro_short_name', type: 'string', maxLength: 40),
                new OA\Property(property: 'pro_organization', type: 'string', maxLength: 10),
                new OA\Property(property: 'unt_code', type: 'string', maxLength: 3),
                new OA\Property(property: 'pro_bom_code', type: 'string', maxLength: 18),
                new OA\Property(property: 'cl2_code', type: 'string', maxLength: 18),
                new OA\Property(property: 'pro_weight', type: 'number', format: 'float'),
            ]
        )),
        responses: [new OA\Response(response: 201, description: 'Producto creado'), new OA\Response(response: 422, description: 'Error de validación')]
    )]
    public function storeProduct() {}

    #[OA\Get(path: '/products/{id}', summary: 'Obtener producto', tags: ['Productos - Product'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))],
        responses: [new OA\Response(response: 200, description: 'Detalle del producto')]
    )]
    public function showProduct() {}

    #[OA\Put(path: '/products/{id}', summary: 'Actualizar producto', tags: ['Productos - Product'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))],
        requestBody: new OA\RequestBody(required: true, content: new OA\JsonContent(properties: [
            new OA\Property(property: 'pro_code', type: 'string', maxLength: 18),
            new OA\Property(property: 'pro_name', type: 'string', maxLength: 40),
        ])),
        responses: [new OA\Response(response: 200, description: 'Producto actualizado')]
    )]
    public function updateProduct() {}

    #[OA\Delete(path: '/products/{id}', summary: 'Eliminar producto', tags: ['Productos - Product'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))],
        responses: [new OA\Response(response: 200, description: 'Producto eliminado')]
    )]
    public function deleteProduct() {}

    // ═══════════════════════════════════════════════
    //  MASTER PRODUCT (bulk) — Formato Polar
    // ═══════════════════════════════════════════════
    #[OA\Post(path: '/masterproduct', summary: 'Carga masiva de datos maestros de producto (formato Polar)', tags: ['Cargas Masivas - MasterProduct'],
        security: [['sanctum' => []]],
        requestBody: new OA\RequestBody(required: true, content: new OA\JsonContent(
            type: 'array',
            items: new OA\Items(type: 'object', properties: [
                new OA\Property(property: 'name', type: 'string', example: 'PRODUCTS'),
                new OA\Property(property: 'value', type: 'object', properties: [
                    new OA\Property(property: 'unit', type: 'array', items: new OA\Items(type: 'object', properties: [
                        new OA\Property(property: 'untCode', type: 'string', example: 'CJ'),
                        new OA\Property(property: 'untName', type: 'string', example: 'CAJA'),
                        new OA\Property(property: 'untNick', type: 'string', example: 'CJ'),
                    ])),
                    new OA\Property(property: 'class1', type: 'array', items: new OA\Items(type: 'object', properties: [
                        new OA\Property(property: 'cl1code', type: 'string', example: 'FAM01'),
                        new OA\Property(property: 'cl1name', type: 'string', example: 'CERVEZAS'),
                    ])),
                    new OA\Property(property: 'class2', type: 'array', items: new OA\Items(type: 'object', properties: [
                        new OA\Property(property: 'cl2code', type: 'string', example: 'CAT01'),
                        new OA\Property(property: 'cl1code', type: 'string', example: 'FAM01'),
                        new OA\Property(property: 'cl2name', type: 'string', example: 'PILSEN'),
                    ])),
                    new OA\Property(property: 'class3', type: 'array', items: new OA\Items(type: 'object', properties: [
                        new OA\Property(property: 'cl3code', type: 'string', example: 'FAM01-PILSEN-001'),
                        new OA\Property(property: 'cl2code', type: 'string', example: 'CAT01'),
                        new OA\Property(property: 'cl3name', type: 'string', example: 'PILSEN PREMIUM'),
                    ])),
                    new OA\Property(property: 'product', type: 'array', items: new OA\Items(type: 'object', properties: [
                        new OA\Property(property: 'proCode', type: 'string', example: 'PROD001'),
                        new OA\Property(property: 'proName', type: 'string', example: 'POLAR PILSEN 222ML'),
                        new OA\Property(property: 'proShortName', type: 'string', example: 'PILSEN 222'),
                        new OA\Property(property: 'untCode', type: 'string', example: 'CJ'),
                        new OA\Property(property: 'cl2code', type: 'string', example: 'CAT01'),
                        new OA\Property(property: 'cl3code', type: 'string', example: 'FAM01-PILSEN-001'),
                    ])),
                    new OA\Property(property: 'productUnit', type: 'array', items: new OA\Items(type: 'object', properties: [
                        new OA\Property(property: 'proCode', type: 'string', example: 'PROD001'),
                        new OA\Property(property: 'untCode', type: 'string', example: 'CJ'),
                        new OA\Property(property: 'pruDivideBy', type: 'number', example: 36),
                    ])),
                ]),
            ])
        )),
        responses: [
            new OA\Response(
                response: 200,
                description: 'Registros procesados exitosamente',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'status', type: 'string', example: 'success'),
                        new OA\Property(property: 'message', type: 'string', example: 'Master Product: 1512 procesado(s), 0 omitido(s), 23 duplicado(s) eliminado(s)'),
                        new OA\Property(property: 'data', type: 'object', properties: [
                            new OA\Property(property: 'summary', type: 'object', properties: [
                                new OA\Property(property: 'total_processed', type: 'integer', example: 1512),
                                new OA\Property(property: 'total_skipped', type: 'integer', example: 0),
                                new OA\Property(property: 'total_duplicates', type: 'integer', example: 23),
                            ]),
                            new OA\Property(property: 'detail', type: 'object', properties: [
                                new OA\Property(property: 'unit', type: 'object', properties: [
                                    new OA\Property(property: 'processed', type: 'integer', example: 44),
                                    new OA\Property(property: 'skipped', type: 'integer', example: 0),
                                    new OA\Property(property: 'duplicates_removed', type: 'integer', example: 0),
                                ]),
                                new OA\Property(property: 'class1', type: 'object', properties: [
                                    new OA\Property(property: 'processed', type: 'integer', example: 5),
                                    new OA\Property(property: 'skipped', type: 'integer', example: 0),
                                    new OA\Property(property: 'duplicates_removed', type: 'integer', example: 0),
                                ]),
                                new OA\Property(property: 'class2', type: 'object', properties: [
                                    new OA\Property(property: 'processed', type: 'integer', example: 32),
                                    new OA\Property(property: 'skipped', type: 'integer', example: 0),
                                    new OA\Property(property: 'duplicates_removed', type: 'integer', example: 0),
                                ]),
                                new OA\Property(property: 'class3', type: 'object', properties: [
                                    new OA\Property(property: 'processed', type: 'integer', example: 45),
                                    new OA\Property(property: 'skipped', type: 'integer', example: 0),
                                    new OA\Property(property: 'duplicates_removed', type: 'integer', example: 0),
                                ]),
                                new OA\Property(property: 'product', type: 'object', properties: [
                                    new OA\Property(property: 'processed', type: 'integer', example: 497),
                                    new OA\Property(property: 'skipped', type: 'integer', example: 0),
                                    new OA\Property(property: 'duplicates_removed', type: '2'),
                                ]),
                                new OA\Property(property: 'productUnit', type: 'object', properties: [
                                    new OA\Property(property: 'processed', type: 'integer', example: 889),
                                    new OA\Property(property: 'skipped', type: 'integer', example: 0),
                                    new OA\Property(property: 'duplicates_removed', type: '21'),
                                ]),
                            ]),
                        ]),
                    ]
                )
            ),
            new OA\Response(response: 422, description: 'Formato no reconocido'),
            new OA\Response(response: 500, description: 'Error en la carga masiva'),
        ]
    )]
    public function masterProduct() {}

    // ═══════════════════════════════════════════════
    //  TRUNCATE PRODUCTS (wipe all product tables)
    // ═══════════════════════════════════════════════
    #[OA\Delete(path: '/truncate-products', summary: 'Truncar tablas de productos', tags: ['Cargas Masivas - MasterProduct'],
        description: 'Vacía todas las tablas relacionadas con datos maestros de producto (product_units, products, product_categories, product_families, units) respetando el orden de dependencias.',
        responses: [
            new OA\Response(response: 200, description: 'Tablas truncadas exitosamente', content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: 'status', type: 'string', example: 'success'),
                    new OA\Property(property: 'message', type: 'string', example: 'Truncate completado: 4553 registro(s) eliminado(s)'),
                    new OA\Property(property: 'data', type: 'object', properties: [
                        new OA\Property(property: 'product_units', type: 'integer', example: 3554),
                        new OA\Property(property: 'products', type: 'integer', example: 497),
                        new OA\Property(property: 'product_categories', type: 'integer', example: 32),
                        new OA\Property(property: 'product_class_3', type: 'integer', example: 45),
                        new OA\Property(property: 'product_families', type: 'integer', example: 5),
                        new OA\Property(property: 'units', type: 'integer', example: 44),
                    ]),
                ]
            )),
            new OA\Response(response: 500, description: 'Error interno'),
        ]
    )]
    public function truncateProducts() {}

    // --- PRODUCT UNITS ---
    #[OA\Get(path: '/product_units', summary: 'Listar unidades de producto', tags: ['Productos - ProductUnit'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'per_page', in: 'query', required: false, schema: new OA\Schema(type: 'integer', default: 15))],
        responses: [new OA\Response(response: 200, description: 'Lista')]
    )]
    public function listProductUnits() {}

    #[OA\Post(path: '/product_units', summary: 'Crear unidad de producto', tags: ['Productos - ProductUnit'],
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

    #[OA\Get(path: '/product_units/{id}', summary: 'Obtener unidad de producto', tags: ['Productos - ProductUnit'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))],
        responses: [new OA\Response(response: 200, description: 'Detalle')]
    )]
    public function showProductUnit() {}

    #[OA\Put(path: '/product_units/{id}', summary: 'Actualizar unidad de producto', tags: ['Productos - ProductUnit'],
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

    #[OA\Delete(path: '/product_units/{id}', summary: 'Eliminar unidad de producto', tags: ['Productos - ProductUnit'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))],
        responses: [new OA\Response(response: 200, description: 'Unidad eliminada')]
    )]
    public function deleteProductUnit() {}

    // --- UNITS ---
    #[OA\Get(path: '/units', summary: 'Listar unidades de medida', tags: ['Productos - Unit'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'per_page', in: 'query', required: false, schema: new OA\Schema(type: 'integer', default: 15))],
        responses: [new OA\Response(response: 200, description: 'Lista')]
    )]
    public function listUnits() {}

    #[OA\Post(path: '/units', summary: 'Crear unidad de medida', tags: ['Productos - Unit'],
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

    #[OA\Get(path: '/units/{id}', summary: 'Obtener unidad de medida', tags: ['Productos - Unit'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))],
        responses: [new OA\Response(response: 200, description: 'Detalle')]
    )]
    public function showUnit() {}

    #[OA\Put(path: '/units/{id}', summary: 'Actualizar unidad de medida', tags: ['Productos - Unit'],
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

    #[OA\Delete(path: '/units/{id}', summary: 'Eliminar unidad de medida', tags: ['Productos - Unit'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))],
        responses: [new OA\Response(response: 200, description: 'Unidad eliminada')]
    )]
    public function deleteUnit() {}

    // --- PRODUCT FAMILIES (class1) ---
    #[OA\Get(path: '/product_families', summary: 'Listar familias de producto', tags: ['Productos - ProductFamily'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'per_page', in: 'query', required: false, schema: new OA\Schema(type: 'integer', default: 15))],
        responses: [new OA\Response(response: 200, description: 'Lista')]
    )]
    public function listProductFamilies() {}

    #[OA\Post(path: '/product_families', summary: 'Crear familia de producto', tags: ['Productos - ProductFamily'],
        security: [['sanctum' => []]],
        requestBody: new OA\RequestBody(required: true, content: new OA\JsonContent(
            required: ['cl1_code', 'cl1_name'],
            properties: [
                new OA\Property(property: 'cl1_code', type: 'string', maxLength: 18),
                new OA\Property(property: 'cl1_name', type: 'string', maxLength: 40),
            ]
        )),
        responses: [new OA\Response(response: 201, description: 'Familia creada')]
    )]
    public function storeProductFamily() {}

    #[OA\Get(path: '/product_families/{id}', summary: 'Obtener familia de producto', tags: ['Productos - ProductFamily'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))],
        responses: [new OA\Response(response: 200, description: 'Detalle')]
    )]
    public function showProductFamily() {}

    #[OA\Put(path: '/product_families/{id}', summary: 'Actualizar familia de producto', tags: ['Productos - ProductFamily'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))],
        requestBody: new OA\RequestBody(required: true, content: new OA\JsonContent(properties: [
            new OA\Property(property: 'cl1_code', type: 'string', maxLength: 18),
            new OA\Property(property: 'cl1_name', type: 'string', maxLength: 40),
        ])),
        responses: [new OA\Response(response: 200, description: 'Familia actualizada')]
    )]
    public function updateProductFamily() {}

    #[OA\Delete(path: '/product_families/{id}', summary: 'Eliminar familia de producto', tags: ['Productos - ProductFamily'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))],
        responses: [new OA\Response(response: 200, description: 'Familia eliminada')]
    )]
    public function deleteProductFamily() {}

    // --- PRODUCT CATEGORIES (class2) ---
    #[OA\Get(path: '/product_categories', summary: 'Listar categorías de producto', tags: ['Productos - ProductCategory'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'per_page', in: 'query', required: false, schema: new OA\Schema(type: 'integer', default: 15))],
        responses: [new OA\Response(response: 200, description: 'Lista')]
    )]
    public function listProductCategories() {}

    #[OA\Post(path: '/product_categories', summary: 'Crear categoría de producto', tags: ['Productos - ProductCategory'],
        security: [['sanctum' => []]],
        requestBody: new OA\RequestBody(required: true, content: new OA\JsonContent(
            required: ['cl2_code', 'cl1_code', 'cl2_name'],
            properties: [
                new OA\Property(property: 'cl2_code', type: 'string', maxLength: 18),
                new OA\Property(property: 'cl1_code', type: 'string', maxLength: 18),
                new OA\Property(property: 'cl2_name', type: 'string', maxLength: 40),
            ]
        )),
        responses: [new OA\Response(response: 201, description: 'Categoría creada')]
    )]
    public function storeProductCategory() {}

    #[OA\Get(path: '/product_categories/{id}', summary: 'Obtener categoría de producto', tags: ['Productos - ProductCategory'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))],
        responses: [new OA\Response(response: 200, description: 'Detalle')]
    )]
    public function showProductCategory() {}

    #[OA\Put(path: '/product_categories/{id}', summary: 'Actualizar categoría de producto', tags: ['Productos - ProductCategory'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))],
        requestBody: new OA\RequestBody(required: true, content: new OA\JsonContent(properties: [
            new OA\Property(property: 'cl2_code', type: 'string', maxLength: 18),
            new OA\Property(property: 'cl1_code', type: 'string', maxLength: 18),
            new OA\Property(property: 'cl2_name', type: 'string', maxLength: 40),
        ])),
        responses: [new OA\Response(response: 200, description: 'Categoría actualizada')]
    )]
    public function updateProductCategory() {}

    #[OA\Delete(path: '/product_categories/{id}', summary: 'Eliminar categoría de producto', tags: ['Productos - ProductCategory'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))],
        responses: [new OA\Response(response: 200, description: 'Categoría eliminada')]
    )]
    public function deleteProductCategory() {}
}
