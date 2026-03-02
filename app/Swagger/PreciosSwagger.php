<?php

namespace App\Swagger;

use OpenApi\Attributes as OA;

class PreciosSwagger
{
    // --- PRICES ---
    #[OA\Get(path: '/prices', summary: 'Listar precios (paginado)', tags: ['Precios - Price'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'per_page', in: 'query', required: false, schema: new OA\Schema(type: 'integer', default: 15))],
        responses: [new OA\Response(response: 200, description: 'Lista de precios')]
    )]
    public function listPrices() {}

    #[OA\Post(path: '/prices', summary: 'Crear precio', tags: ['Precios - Price'],
        security: [['sanctum' => []]],
        requestBody: new OA\RequestBody(required: true, content: new OA\JsonContent(
            required: ['prc_code', 'prc_name'],
            properties: [
                new OA\Property(property: 'prc_code', type: 'string', maxLength: 18),
                new OA\Property(property: 'prc_name', type: 'string', maxLength: 20),
            ]
        )),
        responses: [new OA\Response(response: 201, description: 'Precio creado')]
    )]
    public function storePrice() {}

    #[OA\Get(path: '/prices/{id}', summary: 'Obtener precio', tags: ['Precios - Price'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))],
        responses: [new OA\Response(response: 200, description: 'Detalle')]
    )]
    public function showPrice() {}

    #[OA\Put(path: '/prices/{id}', summary: 'Actualizar precio', tags: ['Precios - Price'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))],
        requestBody: new OA\RequestBody(required: true, content: new OA\JsonContent(properties: [
            new OA\Property(property: 'prc_code', type: 'string', maxLength: 18),
            new OA\Property(property: 'prc_name', type: 'string', maxLength: 20),
        ])),
        responses: [new OA\Response(response: 200, description: 'Precio actualizado')]
    )]
    public function updatePrice() {}

    #[OA\Delete(path: '/prices/{id}', summary: 'Eliminar precio', tags: ['Precios - Price'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))],
        responses: [new OA\Response(response: 200, description: 'Precio eliminado')]
    )]
    public function deletePrice() {}

    // --- PRICE PRODUCTS ---
    #[OA\Get(path: '/price_products', summary: 'Listar productos de precio', tags: ['Precios - PriceProduct'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'per_page', in: 'query', required: false, schema: new OA\Schema(type: 'integer', default: 15))],
        responses: [new OA\Response(response: 200, description: 'Lista')]
    )]
    public function listPriceProducts() {}

    #[OA\Post(path: '/price_products', summary: 'Crear producto de precio', tags: ['Precios - PriceProduct'],
        security: [['sanctum' => []]],
        requestBody: new OA\RequestBody(required: true, content: new OA\JsonContent(
            required: ['prc_code', 'pro_code', 'unt_code', 'ppr_date1', 'ppr_price1_date1'],
            properties: [
                new OA\Property(property: 'prc_code', type: 'string', maxLength: 18),
                new OA\Property(property: 'pro_code', type: 'string', maxLength: 18),
                new OA\Property(property: 'unt_code', type: 'string', maxLength: 3),
                new OA\Property(property: 'ppr_date1', type: 'string', format: 'date'),
                new OA\Property(property: 'ppr_price1_date1', type: 'number', format: 'float'),
            ]
        )),
        responses: [new OA\Response(response: 201, description: 'Producto de precio creado')]
    )]
    public function storePriceProduct() {}

    #[OA\Get(path: '/price_products/{id}', summary: 'Obtener producto de precio', tags: ['Precios - PriceProduct'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))],
        responses: [new OA\Response(response: 200, description: 'Detalle')]
    )]
    public function showPriceProduct() {}

    #[OA\Put(path: '/price_products/{id}', summary: 'Actualizar producto de precio', tags: ['Precios - PriceProduct'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))],
        requestBody: new OA\RequestBody(required: true, content: new OA\JsonContent(properties: [
            new OA\Property(property: 'prc_code', type: 'string', maxLength: 18),
            new OA\Property(property: 'pro_code', type: 'string', maxLength: 18),
            new OA\Property(property: 'unt_code', type: 'string', maxLength: 3),
        ])),
        responses: [new OA\Response(response: 200, description: 'Producto actualizado')]
    )]
    public function updatePriceProduct() {}

    #[OA\Delete(path: '/price_products/{id}', summary: 'Eliminar producto de precio', tags: ['Precios - PriceProduct'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))],
        responses: [new OA\Response(response: 200, description: 'Producto eliminado')]
    )]
    public function deletePriceProduct() {}

    // --- TAXES ---
    #[OA\Get(path: '/taxes', summary: 'Listar impuestos', tags: ['Precios - Tax'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'per_page', in: 'query', required: false, schema: new OA\Schema(type: 'integer', default: 15))],
        responses: [new OA\Response(response: 200, description: 'Lista')]
    )]
    public function listTaxes() {}

    #[OA\Post(path: '/taxes', summary: 'Crear impuesto', tags: ['Precios - Tax'],
        security: [['sanctum' => []]],
        requestBody: new OA\RequestBody(required: true, content: new OA\JsonContent(
            required: ['tax_code', 'tax_name'],
            properties: [
                new OA\Property(property: 'tax_code', type: 'string', maxLength: 4),
                new OA\Property(property: 'tax_name', type: 'string', maxLength: 20),
            ]
        )),
        responses: [new OA\Response(response: 201, description: 'Impuesto creado')]
    )]
    public function storeTax() {}

    #[OA\Get(path: '/taxes/{id}', summary: 'Obtener impuesto', tags: ['Precios - Tax'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))],
        responses: [new OA\Response(response: 200, description: 'Detalle')]
    )]
    public function showTax() {}

    #[OA\Put(path: '/taxes/{id}', summary: 'Actualizar impuesto', tags: ['Precios - Tax'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))],
        requestBody: new OA\RequestBody(required: true, content: new OA\JsonContent(properties: [
            new OA\Property(property: 'tax_code', type: 'string', maxLength: 4),
            new OA\Property(property: 'tax_name', type: 'string', maxLength: 20),
        ])),
        responses: [new OA\Response(response: 200, description: 'Impuesto actualizado')]
    )]
    public function updateTax() {}

    #[OA\Delete(path: '/taxes/{id}', summary: 'Eliminar impuesto', tags: ['Precios - Tax'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))],
        responses: [new OA\Response(response: 200, description: 'Impuesto eliminado')]
    )]
    public function deleteTax() {}

    // --- TAXATIONS ---
    #[OA\Get(path: '/taxations', summary: 'Listar clasificaciones fiscales', tags: ['Precios - Taxation'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'per_page', in: 'query', required: false, schema: new OA\Schema(type: 'integer', default: 15))],
        responses: [new OA\Response(response: 200, description: 'Lista')]
    )]
    public function listTaxations() {}

    #[OA\Post(path: '/taxations', summary: 'Crear clasificación fiscal', tags: ['Precios - Taxation'],
        security: [['sanctum' => []]],
        requestBody: new OA\RequestBody(required: true, content: new OA\JsonContent(
            required: ['txn_code', 'txn_name'],
            properties: [
                new OA\Property(property: 'txn_code', type: 'string', maxLength: 5),
                new OA\Property(property: 'txn_name', type: 'string', maxLength: 20),
            ]
        )),
        responses: [new OA\Response(response: 201, description: 'Clasificación creada')]
    )]
    public function storeTaxation() {}

    #[OA\Get(path: '/taxations/{id}', summary: 'Obtener clasificación fiscal', tags: ['Precios - Taxation'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))],
        responses: [new OA\Response(response: 200, description: 'Detalle')]
    )]
    public function showTaxation() {}

    #[OA\Put(path: '/taxations/{id}', summary: 'Actualizar clasificación', tags: ['Precios - Taxation'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))],
        requestBody: new OA\RequestBody(required: true, content: new OA\JsonContent(properties: [
            new OA\Property(property: 'txn_code', type: 'string', maxLength: 5),
            new OA\Property(property: 'txn_name', type: 'string', maxLength: 20),
        ])),
        responses: [new OA\Response(response: 200, description: 'Clasificación actualizada')]
    )]
    public function updateTaxation() {}

    #[OA\Delete(path: '/taxations/{id}', summary: 'Eliminar clasificación', tags: ['Precios - Taxation'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))],
        responses: [new OA\Response(response: 200, description: 'Clasificación eliminada')]
    )]
    public function deleteTaxation() {}

    // --- TAXATION TAXES ---
    #[OA\Get(path: '/taxation_taxes', summary: 'Listar impuestos por clasificación', tags: ['Precios - TaxationTax'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'per_page', in: 'query', required: false, schema: new OA\Schema(type: 'integer', default: 15))],
        responses: [new OA\Response(response: 200, description: 'Lista')]
    )]
    public function listTaxationTaxes() {}

    #[OA\Post(path: '/taxation_taxes', summary: 'Crear impuesto por clasificación', tags: ['Precios - TaxationTax'],
        security: [['sanctum' => []]],
        requestBody: new OA\RequestBody(required: true, content: new OA\JsonContent(
            required: ['ttx_code', 'txn_code', 'tax_code', 'ttx_date1', 'pro_code', 'ttx_percent_date1', 'unt_code'],
            properties: [
                new OA\Property(property: 'ttx_code', type: 'string', maxLength: 18),
                new OA\Property(property: 'txn_code', type: 'string', maxLength: 1),
                new OA\Property(property: 'tax_code', type: 'string', maxLength: 1),
                new OA\Property(property: 'ttx_date1', type: 'string', format: 'date'),
                new OA\Property(property: 'pro_code', type: 'string', maxLength: 18),
                new OA\Property(property: 'ttx_percent_date1', type: 'number', format: 'float'),
                new OA\Property(property: 'unt_code', type: 'string', maxLength: 3),
            ]
        )),
        responses: [new OA\Response(response: 201, description: 'Impuesto creado')]
    )]
    public function storeTaxationTax() {}

    #[OA\Get(path: '/taxation_taxes/{id}', summary: 'Obtener impuesto por clasificación', tags: ['Precios - TaxationTax'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))],
        responses: [new OA\Response(response: 200, description: 'Detalle')]
    )]
    public function showTaxationTax() {}

    #[OA\Put(path: '/taxation_taxes/{id}', summary: 'Actualizar impuesto por clasificación', tags: ['Precios - TaxationTax'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))],
        requestBody: new OA\RequestBody(required: true, content: new OA\JsonContent(properties: [
            new OA\Property(property: 'ttx_code', type: 'string', maxLength: 18),
            new OA\Property(property: 'txn_code', type: 'string', maxLength: 1),
            new OA\Property(property: 'tax_code', type: 'string', maxLength: 1),
        ])),
        responses: [new OA\Response(response: 200, description: 'Impuesto actualizado')]
    )]
    public function updateTaxationTax() {}

    #[OA\Delete(path: '/taxation_taxes/{id}', summary: 'Eliminar impuesto por clasificación', tags: ['Precios - TaxationTax'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))],
        responses: [new OA\Response(response: 200, description: 'Impuesto eliminado')]
    )]
    public function deleteTaxationTax() {}
}
