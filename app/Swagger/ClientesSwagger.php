<?php

namespace App\Swagger;

use OpenApi\Attributes as OA;

class ClientesSwagger
{
    // ═══════════════════════════════════════════════
    //  CUSTOMERS
    // ═══════════════════════════════════════════════
    #[OA\Get(path: '/customers', summary: 'Listar clientes (paginado)', tags: ['Clientes - Customer'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'per_page', in: 'query', required: false, schema: new OA\Schema(type: 'integer', default: 15))],
        responses: [new OA\Response(response: 200, description: 'Lista de clientes')]
    )]
    public function listCustomers() {}

    #[OA\Post(path: '/customers', summary: 'Crear cliente', tags: ['Clientes - Customer'],
        security: [['sanctum' => []]],
        requestBody: new OA\RequestBody(required: true, content: new OA\JsonContent(
            required: ['cus_code', 'cus_name', 'tp1_code', 'tp2_code', 'cit_code', 'txn_code'],
            properties: [
                new OA\Property(property: 'cus_code', type: 'string', maxLength: 10),
                new OA\Property(property: 'cus_name', type: 'string', maxLength: 35),
                new OA\Property(property: 'tp1_code', type: 'string', maxLength: 3),
                new OA\Property(property: 'tp2_code', type: 'string', maxLength: 10),
                new OA\Property(property: 'cit_code', type: 'string', maxLength: 2),
                new OA\Property(property: 'txn_code', type: 'string', maxLength: 2),
                new OA\Property(property: 'cus_tax_id1', type: 'string', maxLength: 16),
                new OA\Property(property: 'brc_code', type: 'string', maxLength: 10),
                new OA\Property(property: 'prc_code_for_sale', type: 'string', maxLength: 4),
                new OA\Property(property: 'prc_code_for_return', type: 'string', maxLength: 4),
            ]
        )),
        responses: [new OA\Response(response: 201, description: 'Cliente creado'), new OA\Response(response: 422, description: 'Error de validación')]
    )]
    public function storeCustomer() {}

    #[OA\Get(path: '/customers/{id}', summary: 'Obtener cliente', tags: ['Clientes - Customer'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))],
        responses: [new OA\Response(response: 200, description: 'Detalle del cliente')]
    )]
    public function showCustomer() {}

    #[OA\Put(path: '/customers/{id}', summary: 'Actualizar cliente', tags: ['Clientes - Customer'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))],
        requestBody: new OA\RequestBody(required: true, content: new OA\JsonContent(properties: [
            new OA\Property(property: 'cus_code', type: 'string', maxLength: 10),
            new OA\Property(property: 'cus_name', type: 'string', maxLength: 35),
        ])),
        responses: [new OA\Response(response: 200, description: 'Cliente actualizado')]
    )]
    public function updateCustomer() {}

    #[OA\Delete(path: '/customers/{id}', summary: 'Eliminar cliente', tags: ['Clientes - Customer'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))],
        responses: [new OA\Response(response: 200, description: 'Cliente eliminado')]
    )]
    public function deleteCustomer() {}

    // ═══════════════════════════════════════════════
    //  MASTER CUSTOMER (bulk)
    // ═══════════════════════════════════════════════
    #[OA\Post(path: '/mastercustomer', summary: 'Carga masiva de datos maestros de cliente', tags: ['Clientes - MasterCustomer'],
        security: [['sanctum' => []]],
        requestBody: new OA\RequestBody(required: true, content: new OA\JsonContent(
            type: 'array',
            items: new OA\Items(type: 'object', properties: [
                new OA\Property(property: 'Clientes', type: 'object'),
                new OA\Property(property: 'GrupoCliente', type: 'object'),
                new OA\Property(property: 'ramoCliente', type: 'object'),
                new OA\Property(property: 'regionCliente', type: 'object'),
                new OA\Property(property: 'frecuenciaTb', type: 'object'),
                new OA\Property(property: 'frecuenciaCliente', type: 'object'),
                new OA\Property(property: 'licenciaTb', type: 'object'),
            ])
        )),
        responses: [new OA\Response(response: 201, description: 'Registros creados exitosamente')]
    )]
    public function masterCustomer() {}

    // ═══════════════════════════════════════════════
    //  CITIES
    // ═══════════════════════════════════════════════
    #[OA\Get(path: '/cities', summary: 'Listar ciudades', tags: ['Clientes - City'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'per_page', in: 'query', required: false, schema: new OA\Schema(type: 'integer', default: 15))],
        responses: [new OA\Response(response: 200, description: 'Lista de ciudades')]
    )]
    public function listCities() {}

    #[OA\Post(path: '/cities', summary: 'Crear ciudad', tags: ['Clientes - City'],
        security: [['sanctum' => []]],
        requestBody: new OA\RequestBody(required: true, content: new OA\JsonContent(
            required: ['cit_code', 'cit_name', 'sta_code'],
            properties: [
                new OA\Property(property: 'cit_code', type: 'string', maxLength: 2),
                new OA\Property(property: 'cit_name', type: 'string', maxLength: 20),
                new OA\Property(property: 'sta_code', type: 'string', maxLength: 3),
            ]
        )),
        responses: [new OA\Response(response: 201, description: 'Ciudad creada')]
    )]
    public function storeCity() {}

    #[OA\Get(path: '/cities/{id}', summary: 'Obtener ciudad', tags: ['Clientes - City'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))],
        responses: [new OA\Response(response: 200, description: 'Detalle de ciudad')]
    )]
    public function showCity() {}

    #[OA\Put(path: '/cities/{id}', summary: 'Actualizar ciudad', tags: ['Clientes - City'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))],
        requestBody: new OA\RequestBody(required: true, content: new OA\JsonContent(properties: [
            new OA\Property(property: 'cit_code', type: 'string', maxLength: 2),
            new OA\Property(property: 'cit_name', type: 'string', maxLength: 20),
            new OA\Property(property: 'sta_code', type: 'string', maxLength: 3),
        ])),
        responses: [new OA\Response(response: 200, description: 'Ciudad actualizada')]
    )]
    public function updateCity() {}

    #[OA\Delete(path: '/cities/{id}', summary: 'Eliminar ciudad', tags: ['Clientes - City'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))],
        responses: [new OA\Response(response: 200, description: 'Ciudad eliminada')]
    )]
    public function deleteCity() {}

    // ═══════════════════════════════════════════════
    //  CUSTOMER GROUPS
    // ═══════════════════════════════════════════════
    #[OA\Get(path: '/customer_groups', summary: 'Listar grupos de clientes', tags: ['Clientes - CustomerGroup'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'per_page', in: 'query', required: false, schema: new OA\Schema(type: 'integer', default: 15))],
        responses: [new OA\Response(response: 200, description: 'Lista de grupos')]
    )]
    public function listCustomerGroups() {}

    #[OA\Post(path: '/customer_groups', summary: 'Crear grupo de clientes', tags: ['Clientes - CustomerGroup'],
        security: [['sanctum' => []]],
        requestBody: new OA\RequestBody(required: true, content: new OA\JsonContent(
            required: ['tp1_code', 'tp1_name'],
            properties: [
                new OA\Property(property: 'tp1_code', type: 'string', maxLength: 3),
                new OA\Property(property: 'tp1_name', type: 'string', maxLength: 20),
            ]
        )),
        responses: [new OA\Response(response: 201, description: 'Grupo creado')]
    )]
    public function storeCustomerGroup() {}

    #[OA\Get(path: '/customer_groups/{id}', summary: 'Obtener grupo', tags: ['Clientes - CustomerGroup'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))],
        responses: [new OA\Response(response: 200, description: 'Detalle')]
    )]
    public function showCustomerGroup() {}

    #[OA\Put(path: '/customer_groups/{id}', summary: 'Actualizar grupo', tags: ['Clientes - CustomerGroup'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))],
        requestBody: new OA\RequestBody(required: true, content: new OA\JsonContent(properties: [
            new OA\Property(property: 'tp1_code', type: 'string', maxLength: 3),
            new OA\Property(property: 'tp1_name', type: 'string', maxLength: 20),
        ])),
        responses: [new OA\Response(response: 200, description: 'Grupo actualizado')]
    )]
    public function updateCustomerGroup() {}

    #[OA\Delete(path: '/customer_groups/{id}', summary: 'Eliminar grupo', tags: ['Clientes - CustomerGroup'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))],
        responses: [new OA\Response(response: 200, description: 'Grupo eliminado')]
    )]
    public function deleteCustomerGroup() {}

    // ═══════════════════════════════════════════════
    //  CUSTOMER BRANCHES
    // ═══════════════════════════════════════════════
    #[OA\Get(path: '/customer_branches', summary: 'Listar ramos', tags: ['Clientes - CustomerBranch'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'per_page', in: 'query', required: false, schema: new OA\Schema(type: 'integer', default: 15))],
        responses: [new OA\Response(response: 200, description: 'Lista')]
    )]
    public function listCustomerBranches() {}

    #[OA\Post(path: '/customer_branches', summary: 'Crear ramo', tags: ['Clientes - CustomerBranch'],
        security: [['sanctum' => []]],
        requestBody: new OA\RequestBody(required: true, content: new OA\JsonContent(
            required: ['tp2_code', 'tp2_name'],
            properties: [
                new OA\Property(property: 'tp2_code', type: 'string', maxLength: 10),
                new OA\Property(property: 'tp2_name', type: 'string', maxLength: 20),
            ]
        )),
        responses: [new OA\Response(response: 201, description: 'Ramo creado')]
    )]
    public function storeCustomerBranch() {}

    #[OA\Get(path: '/customer_branches/{id}', summary: 'Obtener ramo', tags: ['Clientes - CustomerBranch'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))],
        responses: [new OA\Response(response: 200, description: 'Detalle')]
    )]
    public function showCustomerBranch() {}

    #[OA\Put(path: '/customer_branches/{id}', summary: 'Actualizar ramo', tags: ['Clientes - CustomerBranch'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))],
        requestBody: new OA\RequestBody(required: true, content: new OA\JsonContent(properties: [
            new OA\Property(property: 'tp2_code', type: 'string', maxLength: 10),
            new OA\Property(property: 'tp2_name', type: 'string', maxLength: 20),
        ])),
        responses: [new OA\Response(response: 200, description: 'Ramo actualizado')]
    )]
    public function updateCustomerBranch() {}

    #[OA\Delete(path: '/customer_branches/{id}', summary: 'Eliminar ramo', tags: ['Clientes - CustomerBranch'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))],
        responses: [new OA\Response(response: 200, description: 'Ramo eliminado')]
    )]
    public function deleteCustomerBranch() {}

    // ═══════════════════════════════════════════════
    //  CUSTOMER REGIONS
    // ═══════════════════════════════════════════════
    #[OA\Get(path: '/customer_regions', summary: 'Listar regiones', tags: ['Clientes - CustomerRegion'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'per_page', in: 'query', required: false, schema: new OA\Schema(type: 'integer', default: 15))],
        responses: [new OA\Response(response: 200, description: 'Lista')]
    )]
    public function listCustomerRegions() {}

    #[OA\Post(path: '/customer_regions', summary: 'Crear región', tags: ['Clientes - CustomerRegion'],
        security: [['sanctum' => []]],
        requestBody: new OA\RequestBody(required: true, content: new OA\JsonContent(
            required: ['cit_code', 'cit_name', 'sta_code'],
            properties: [
                new OA\Property(property: 'cit_code', type: 'string', maxLength: 2),
                new OA\Property(property: 'cit_name', type: 'string', maxLength: 20),
                new OA\Property(property: 'sta_code', type: 'string', maxLength: 3),
            ]
        )),
        responses: [new OA\Response(response: 201, description: 'Región creada')]
    )]
    public function storeCustomerRegion() {}

    #[OA\Get(path: '/customer_regions/{id}', summary: 'Obtener región', tags: ['Clientes - CustomerRegion'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))],
        responses: [new OA\Response(response: 200, description: 'Detalle')]
    )]
    public function showCustomerRegion() {}

    #[OA\Put(path: '/customer_regions/{id}', summary: 'Actualizar región', tags: ['Clientes - CustomerRegion'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))],
        requestBody: new OA\RequestBody(required: true, content: new OA\JsonContent(properties: [
            new OA\Property(property: 'cit_code', type: 'string', maxLength: 2),
            new OA\Property(property: 'cit_name', type: 'string', maxLength: 20),
            new OA\Property(property: 'sta_code', type: 'string', maxLength: 3),
        ])),
        responses: [new OA\Response(response: 200, description: 'Región actualizada')]
    )]
    public function updateCustomerRegion() {}

    #[OA\Delete(path: '/customer_regions/{id}', summary: 'Eliminar región', tags: ['Clientes - CustomerRegion'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))],
        responses: [new OA\Response(response: 200, description: 'Región eliminada')]
    )]
    public function deleteCustomerRegion() {}

    // ═══════════════════════════════════════════════
    //  CUSTOMER FREQUENCIES
    // ═══════════════════════════════════════════════
    #[OA\Get(path: '/customer_frequencies', summary: 'Listar frecuencias', tags: ['Clientes - CustomerFrequency'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'per_page', in: 'query', required: false, schema: new OA\Schema(type: 'integer', default: 15))],
        responses: [new OA\Response(response: 200, description: 'Lista')]
    )]
    public function listFrequencies() {}

    #[OA\Post(path: '/customer_frequencies', summary: 'Crear frecuencia', tags: ['Clientes - CustomerFrequency'],
        security: [['sanctum' => []]],
        requestBody: new OA\RequestBody(required: true, content: new OA\JsonContent(
            required: ['fre_code', 'fre_name'],
            properties: [
                new OA\Property(property: 'fre_code', type: 'string', maxLength: 2),
                new OA\Property(property: 'fre_name', type: 'string', maxLength: 40),
                new OA\Property(property: 'fre_week1', type: 'string', maxLength: 1),
                new OA\Property(property: 'fre_week2', type: 'string', maxLength: 1),
                new OA\Property(property: 'fre_week3', type: 'string', maxLength: 1),
                new OA\Property(property: 'fre_week4', type: 'string', maxLength: 1),
                new OA\Property(property: 'fre_customer', type: 'string', maxLength: 1),
            ]
        )),
        responses: [new OA\Response(response: 201, description: 'Frecuencia creada')]
    )]
    public function storeFrequency() {}

    #[OA\Get(path: '/customer_frequencies/{id}', summary: 'Obtener frecuencia', tags: ['Clientes - CustomerFrequency'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))],
        responses: [new OA\Response(response: 200, description: 'Detalle')]
    )]
    public function showFrequency() {}

    #[OA\Put(path: '/customer_frequencies/{id}', summary: 'Actualizar frecuencia', tags: ['Clientes - CustomerFrequency'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))],
        requestBody: new OA\RequestBody(required: true, content: new OA\JsonContent(properties: [
            new OA\Property(property: 'fre_code', type: 'string', maxLength: 2),
            new OA\Property(property: 'fre_name', type: 'string', maxLength: 40),
        ])),
        responses: [new OA\Response(response: 200, description: 'Frecuencia actualizada')]
    )]
    public function updateFrequency() {}

    #[OA\Delete(path: '/customer_frequencies/{id}', summary: 'Eliminar frecuencia', tags: ['Clientes - CustomerFrequency'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))],
        responses: [new OA\Response(response: 200, description: 'Frecuencia eliminada')]
    )]
    public function deleteFrequency() {}

    // ═══════════════════════════════════════════════
    //  CUSTOMER ROUTES
    // ═══════════════════════════════════════════════
    #[OA\Get(path: '/customer_routes', summary: 'Listar rutas de clientes', tags: ['Clientes - CustomerRoute'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'per_page', in: 'query', required: false, schema: new OA\Schema(type: 'integer', default: 15))],
        responses: [new OA\Response(response: 200, description: 'Lista')]
    )]
    public function listCustomerRoutes() {}

    #[OA\Post(path: '/customer_routes', summary: 'Crear ruta de cliente', tags: ['Clientes - CustomerRoute'],
        security: [['sanctum' => []]],
        requestBody: new OA\RequestBody(required: true, content: new OA\JsonContent(
            required: ['rot_code', 'cus_code', 'fre_code'],
            properties: [
                new OA\Property(property: 'rot_code', type: 'string', maxLength: 6),
                new OA\Property(property: 'cus_code', type: 'string', maxLength: 10),
                new OA\Property(property: 'fre_code', type: 'string', maxLength: 2),
                new OA\Property(property: 'ctr_monday', type: 'string', maxLength: 1),
                new OA\Property(property: 'ctr_tuesday', type: 'string', maxLength: 1),
                new OA\Property(property: 'ctr_wednesday', type: 'string', maxLength: 1),
                new OA\Property(property: 'ctr_thursday', type: 'string', maxLength: 1),
                new OA\Property(property: 'ctr_friday', type: 'string', maxLength: 1),
            ]
        )),
        responses: [new OA\Response(response: 201, description: 'Ruta creada')]
    )]
    public function storeCustomerRoute() {}

    #[OA\Get(path: '/customer_routes/{id}', summary: 'Obtener ruta de cliente', tags: ['Clientes - CustomerRoute'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))],
        responses: [new OA\Response(response: 200, description: 'Detalle')]
    )]
    public function showCustomerRoute() {}

    #[OA\Put(path: '/customer_routes/{id}', summary: 'Actualizar ruta de cliente', tags: ['Clientes - CustomerRoute'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))],
        requestBody: new OA\RequestBody(required: true, content: new OA\JsonContent(properties: [
            new OA\Property(property: 'rot_code', type: 'string', maxLength: 6),
            new OA\Property(property: 'cus_code', type: 'string', maxLength: 10),
            new OA\Property(property: 'fre_code', type: 'string', maxLength: 2),
        ])),
        responses: [new OA\Response(response: 200, description: 'Ruta actualizada')]
    )]
    public function updateCustomerRoute() {}

    #[OA\Delete(path: '/customer_routes/{id}', summary: 'Eliminar ruta de cliente', tags: ['Clientes - CustomerRoute'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))],
        responses: [new OA\Response(response: 200, description: 'Ruta eliminada')]
    )]
    public function deleteCustomerRoute() {}

    // ═══════════════════════════════════════════════
    //  CUSTOMER INFOS
    // ═══════════════════════════════════════════════
    #[OA\Get(path: '/customer_infos', summary: 'Listar info de clientes', tags: ['Clientes - CustomerInfo'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'per_page', in: 'query', required: false, schema: new OA\Schema(type: 'integer', default: 15))],
        responses: [new OA\Response(response: 200, description: 'Lista')]
    )]
    public function listCustomerInfos() {}

    #[OA\Post(path: '/customer_infos', summary: 'Crear info de cliente', tags: ['Clientes - CustomerInfo'],
        security: [['sanctum' => []]],
        requestBody: new OA\RequestBody(required: true, content: new OA\JsonContent(
            required: ['cus_code', 'ift_code', 'ctn_char_value'],
            properties: [
                new OA\Property(property: 'cus_code', type: 'string', maxLength: 10),
                new OA\Property(property: 'ift_code', type: 'string', maxLength: 2),
                new OA\Property(property: 'ctn_char_value', type: 'string', maxLength: 32),
            ]
        )),
        responses: [new OA\Response(response: 201, description: 'Info creada')]
    )]
    public function storeCustomerInfo() {}

    #[OA\Get(path: '/customer_infos/{id}', summary: 'Obtener info', tags: ['Clientes - CustomerInfo'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))],
        responses: [new OA\Response(response: 200, description: 'Detalle')]
    )]
    public function showCustomerInfo() {}

    #[OA\Put(path: '/customer_infos/{id}', summary: 'Actualizar info', tags: ['Clientes - CustomerInfo'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))],
        requestBody: new OA\RequestBody(required: true, content: new OA\JsonContent(properties: [
            new OA\Property(property: 'cus_code', type: 'string', maxLength: 10),
            new OA\Property(property: 'ift_code', type: 'string', maxLength: 2),
            new OA\Property(property: 'ctn_char_value', type: 'string', maxLength: 32),
        ])),
        responses: [new OA\Response(response: 200, description: 'Info actualizada')]
    )]
    public function updateCustomerInfo() {}

    #[OA\Delete(path: '/customer_infos/{id}', summary: 'Eliminar info', tags: ['Clientes - CustomerInfo'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))],
        responses: [new OA\Response(response: 200, description: 'Info eliminada')]
    )]
    public function deleteCustomerInfo() {}

    // ═══════════════════════════════════════════════
    //  CUSTOMER PRICES
    // ═══════════════════════════════════════════════
    #[OA\Get(path: '/customer_prices', summary: 'Listar precios de cliente', tags: ['Clientes - CustomerPrice'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'per_page', in: 'query', required: false, schema: new OA\Schema(type: 'integer', default: 15))],
        responses: [new OA\Response(response: 200, description: 'Lista')]
    )]
    public function listCustomerPrices() {}

    #[OA\Post(path: '/customer_prices', summary: 'Crear precio de cliente', tags: ['Clientes - CustomerPrice'],
        security: [['sanctum' => []]],
        requestBody: new OA\RequestBody(required: true, content: new OA\JsonContent(
            required: ['rot_code', 'cus_code', 'prc_code'],
            properties: [
                new OA\Property(property: 'rot_code', type: 'string', maxLength: 6),
                new OA\Property(property: 'cus_code', type: 'string', maxLength: 10),
                new OA\Property(property: 'prc_code', type: 'string', maxLength: 4),
            ]
        )),
        responses: [new OA\Response(response: 201, description: 'Precio creado')]
    )]
    public function storeCustomerPrice() {}

    #[OA\Get(path: '/customer_prices/{id}', summary: 'Obtener precio de cliente', tags: ['Clientes - CustomerPrice'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))],
        responses: [new OA\Response(response: 200, description: 'Detalle')]
    )]
    public function showCustomerPrice() {}

    #[OA\Put(path: '/customer_prices/{id}', summary: 'Actualizar precio de cliente', tags: ['Clientes - CustomerPrice'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))],
        requestBody: new OA\RequestBody(required: true, content: new OA\JsonContent(properties: [
            new OA\Property(property: 'rot_code', type: 'string', maxLength: 6),
            new OA\Property(property: 'cus_code', type: 'string', maxLength: 10),
            new OA\Property(property: 'prc_code', type: 'string', maxLength: 4),
        ])),
        responses: [new OA\Response(response: 200, description: 'Precio actualizado')]
    )]
    public function updateCustomerPrice() {}

    #[OA\Delete(path: '/customer_prices/{id}', summary: 'Eliminar precio de cliente', tags: ['Clientes - CustomerPrice'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))],
        responses: [new OA\Response(response: 200, description: 'Precio eliminado')]
    )]
    public function deleteCustomerPrice() {}

    // ═══════════════════════════════════════════════
    //  INFO TYPES
    // ═══════════════════════════════════════════════
    #[OA\Get(path: '/info_types', summary: 'Listar tipos de info', tags: ['Clientes - InfoType'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'per_page', in: 'query', required: false, schema: new OA\Schema(type: 'integer', default: 15))],
        responses: [new OA\Response(response: 200, description: 'Lista')]
    )]
    public function listInfoTypes() {}

    #[OA\Post(path: '/info_types', summary: 'Crear tipo de info', tags: ['Clientes - InfoType'],
        security: [['sanctum' => []]],
        requestBody: new OA\RequestBody(required: true, content: new OA\JsonContent(
            required: ['ift_code', 'ift_name', 'ift_char_type'],
            properties: [
                new OA\Property(property: 'ift_code', type: 'string', maxLength: 2),
                new OA\Property(property: 'ift_name', type: 'string', maxLength: 40),
                new OA\Property(property: 'ift_char_type', type: 'string', maxLength: 2),
            ]
        )),
        responses: [new OA\Response(response: 201, description: 'Tipo creado')]
    )]
    public function storeInfoType() {}

    #[OA\Get(path: '/info_types/{id}', summary: 'Obtener tipo de info', tags: ['Clientes - InfoType'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))],
        responses: [new OA\Response(response: 200, description: 'Detalle')]
    )]
    public function showInfoType() {}

    #[OA\Put(path: '/info_types/{id}', summary: 'Actualizar tipo de info', tags: ['Clientes - InfoType'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))],
        requestBody: new OA\RequestBody(required: true, content: new OA\JsonContent(properties: [
            new OA\Property(property: 'ift_code', type: 'string', maxLength: 2),
            new OA\Property(property: 'ift_name', type: 'string', maxLength: 40),
            new OA\Property(property: 'ift_char_type', type: 'string', maxLength: 2),
        ])),
        responses: [new OA\Response(response: 200, description: 'Tipo actualizado')]
    )]
    public function updateInfoType() {}

    #[OA\Delete(path: '/info_types/{id}', summary: 'Eliminar tipo de info', tags: ['Clientes - InfoType'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))],
        responses: [new OA\Response(response: 200, description: 'Tipo eliminado')]
    )]
    public function deleteInfoType() {}
}
