<?php

namespace App\Swagger;

use OpenApi\Attributes as OA;

class RutasSwagger
{
    // --- ROUTES ---
    #[OA\Get(path: '/routes', summary: 'Listar rutas (paginado)', tags: ['Rutas'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'per_page', in: 'query', required: false, schema: new OA\Schema(type: 'integer', default: 15))],
        responses: [new OA\Response(response: 200, description: 'Lista de rutas')]
    )]
    public function listRoutes() {}

    #[OA\Post(path: '/routes', summary: 'Crear ruta', tags: ['Rutas'],
        security: [['sanctum' => []]],
        requestBody: new OA\RequestBody(required: true, content: new OA\JsonContent(
            required: ['rot_code', 'rot_name', 'lgn_code', 'try_code'],
            properties: [
                new OA\Property(property: 'rot_code', type: 'string', maxLength: 6),
                new OA\Property(property: 'rot_name', type: 'string', maxLength: 30),
                new OA\Property(property: 'lgn_code', type: 'string', maxLength: 6),
                new OA\Property(property: 'try_code', type: 'string', maxLength: 10),
            ]
        )),
        responses: [new OA\Response(response: 201, description: 'Ruta creada')]
    )]
    public function storeRoute() {}

    #[OA\Get(path: '/routes/{id}', summary: 'Obtener ruta', tags: ['Rutas'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))],
        responses: [new OA\Response(response: 200, description: 'Detalle')]
    )]
    public function showRoute() {}

    #[OA\Put(path: '/routes/{id}', summary: 'Actualizar ruta', tags: ['Rutas'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))],
        requestBody: new OA\RequestBody(required: true, content: new OA\JsonContent(properties: [
            new OA\Property(property: 'rot_code', type: 'string', maxLength: 6),
            new OA\Property(property: 'rot_name', type: 'string', maxLength: 30),
        ])),
        responses: [new OA\Response(response: 200, description: 'Ruta actualizada')]
    )]
    public function updateRoute() {}

    #[OA\Delete(path: '/routes/{id}', summary: 'Eliminar ruta', tags: ['Rutas'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))],
        responses: [new OA\Response(response: 200, description: 'Ruta eliminada')]
    )]
    public function deleteRoute() {}

    // --- ROUTE LOGINS ---
    #[OA\Get(path: '/route_logins', summary: 'Listar logins de ruta', tags: ['Rutas'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'per_page', in: 'query', required: false, schema: new OA\Schema(type: 'integer', default: 15))],
        responses: [new OA\Response(response: 200, description: 'Lista')]
    )]
    public function listRouteLogins() {}

    #[OA\Post(path: '/route_logins', summary: 'Crear login de ruta', tags: ['Rutas'],
        security: [['sanctum' => []]],
        requestBody: new OA\RequestBody(required: true, content: new OA\JsonContent(
            required: ['rot_code', 'lgn_code'],
            properties: [
                new OA\Property(property: 'rot_code', type: 'string', maxLength: 6),
                new OA\Property(property: 'lgn_code', type: 'string', maxLength: 6),
            ]
        )),
        responses: [new OA\Response(response: 201, description: 'Login creado')]
    )]
    public function storeRouteLogin() {}

    #[OA\Get(path: '/route_logins/{id}', summary: 'Obtener login de ruta', tags: ['Rutas'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))],
        responses: [new OA\Response(response: 200, description: 'Detalle')]
    )]
    public function showRouteLogin() {}

    #[OA\Put(path: '/route_logins/{id}', summary: 'Actualizar login de ruta', tags: ['Rutas'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))],
        requestBody: new OA\RequestBody(required: true, content: new OA\JsonContent(properties: [
            new OA\Property(property: 'rot_code', type: 'string', maxLength: 6),
            new OA\Property(property: 'lgn_code', type: 'string', maxLength: 6),
        ])),
        responses: [new OA\Response(response: 200, description: 'Login actualizado')]
    )]
    public function updateRouteLogin() {}

    #[OA\Delete(path: '/route_logins/{id}', summary: 'Eliminar login de ruta', tags: ['Rutas'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))],
        responses: [new OA\Response(response: 200, description: 'Login eliminado')]
    )]
    public function deleteRouteLogin() {}

    // --- ROUTE GENERALS ---
    #[OA\Get(path: '/route_generals', summary: 'Listar datos generales de ruta', tags: ['Rutas'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'per_page', in: 'query', required: false, schema: new OA\Schema(type: 'integer', default: 15))],
        responses: [new OA\Response(response: 200, description: 'Lista')]
    )]
    public function listRouteGenerals() {}

    #[OA\Post(path: '/route_generals', summary: 'Crear dato general de ruta', tags: ['Rutas'],
        security: [['sanctum' => []]],
        requestBody: new OA\RequestBody(required: true, content: new OA\JsonContent(
            required: ['rot_code'],
            properties: [new OA\Property(property: 'rot_code', type: 'string', maxLength: 6)]
        )),
        responses: [new OA\Response(response: 201, description: 'Dato creado')]
    )]
    public function storeRouteGeneral() {}

    #[OA\Get(path: '/route_generals/{id}', summary: 'Obtener dato general', tags: ['Rutas'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))],
        responses: [new OA\Response(response: 200, description: 'Detalle')]
    )]
    public function showRouteGeneral() {}

    #[OA\Put(path: '/route_generals/{id}', summary: 'Actualizar dato general', tags: ['Rutas'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))],
        requestBody: new OA\RequestBody(required: true, content: new OA\JsonContent(properties: [
            new OA\Property(property: 'rot_code', type: 'string', maxLength: 6),
        ])),
        responses: [new OA\Response(response: 200, description: 'Dato actualizado')]
    )]
    public function updateRouteGeneral() {}

    #[OA\Delete(path: '/route_generals/{id}', summary: 'Eliminar dato general', tags: ['Rutas'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))],
        responses: [new OA\Response(response: 200, description: 'Dato eliminado')]
    )]
    public function deleteRouteGeneral() {}

    // --- ROUTE ASSET TYPES ---
    #[OA\Get(path: '/route_asset_types', summary: 'Listar tipos de activo', tags: ['Rutas'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'per_page', in: 'query', required: false, schema: new OA\Schema(type: 'integer', default: 15))],
        responses: [new OA\Response(response: 200, description: 'Lista')]
    )]
    public function listRouteAssetTypes() {}

    #[OA\Post(path: '/route_asset_types', summary: 'Crear tipo de activo', tags: ['Rutas'],
        security: [['sanctum' => []]],
        requestBody: new OA\RequestBody(required: true, content: new OA\JsonContent(
            required: ['rot_code', 'att_code'],
            properties: [
                new OA\Property(property: 'rot_code', type: 'string', maxLength: 6),
                new OA\Property(property: 'att_code', type: 'string', maxLength: 10),
            ]
        )),
        responses: [new OA\Response(response: 201, description: 'Tipo creado')]
    )]
    public function storeRouteAssetType() {}

    #[OA\Get(path: '/route_asset_types/{id}', summary: 'Obtener tipo de activo', tags: ['Rutas'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))],
        responses: [new OA\Response(response: 200, description: 'Detalle')]
    )]
    public function showRouteAssetType() {}

    #[OA\Put(path: '/route_asset_types/{id}', summary: 'Actualizar tipo de activo', tags: ['Rutas'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))],
        requestBody: new OA\RequestBody(required: true, content: new OA\JsonContent(properties: [
            new OA\Property(property: 'rot_code', type: 'string', maxLength: 6),
            new OA\Property(property: 'att_code', type: 'string', maxLength: 10),
        ])),
        responses: [new OA\Response(response: 200, description: 'Tipo actualizado')]
    )]
    public function updateRouteAssetType() {}

    #[OA\Delete(path: '/route_asset_types/{id}', summary: 'Eliminar tipo de activo', tags: ['Rutas'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))],
        responses: [new OA\Response(response: 200, description: 'Tipo eliminado')]
    )]
    public function deleteRouteAssetType() {}

    // --- JOURNEYS ---
    #[OA\Get(path: '/journeys', summary: 'Listar jornadas', tags: ['Rutas'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'per_page', in: 'query', required: false, schema: new OA\Schema(type: 'integer', default: 15))],
        responses: [new OA\Response(response: 200, description: 'Lista')]
    )]
    public function listJourneys() {}

    #[OA\Post(path: '/journeys', summary: 'Crear jornada', tags: ['Rutas'],
        security: [['sanctum' => []]],
        requestBody: new OA\RequestBody(required: true, content: new OA\JsonContent(
            required: ['jrn_code', 'rot_code'],
            properties: [
                new OA\Property(property: 'jrn_code', type: 'string', maxLength: 10),
                new OA\Property(property: 'rot_code', type: 'string', maxLength: 6),
            ]
        )),
        responses: [new OA\Response(response: 201, description: 'Jornada creada')]
    )]
    public function storeJourney() {}

    #[OA\Get(path: '/journeys/{id}', summary: 'Obtener jornada', tags: ['Rutas'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))],
        responses: [new OA\Response(response: 200, description: 'Detalle')]
    )]
    public function showJourney() {}

    #[OA\Put(path: '/journeys/{id}', summary: 'Actualizar jornada', tags: ['Rutas'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))],
        requestBody: new OA\RequestBody(required: true, content: new OA\JsonContent(properties: [
            new OA\Property(property: 'jrn_code', type: 'string', maxLength: 10),
            new OA\Property(property: 'rot_code', type: 'string', maxLength: 6),
        ])),
        responses: [new OA\Response(response: 200, description: 'Jornada actualizada')]
    )]
    public function updateJourney() {}

    #[OA\Delete(path: '/journeys/{id}', summary: 'Eliminar jornada', tags: ['Rutas'],
        security: [['sanctum' => []]],
        parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))],
        responses: [new OA\Response(response: 200, description: 'Jornada eliminada')]
    )]
    public function deleteJourney() {}
}
