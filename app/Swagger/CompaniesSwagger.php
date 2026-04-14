<?php

namespace App\Swagger;

use OpenApi\Attributes as OA;

class CompaniesSwagger
{
    // ═══════════════════════════════════════════════
    //  MASTER COMPANY (bulk) — Formato Polar
    // ═══════════════════════════════════════════════
    #[OA\Post(path: '/mastercompany', summary: 'Carga masiva de datos organizacionales de empresa (formato Polar)', tags: ['Cargas Masivas - MasterCompany'],
        security: [['sanctum' => []]],
        requestBody: new OA\RequestBody(required: true, content: new OA\JsonContent(
            type: 'array',
            items: new OA\Items(type: 'object', properties: [
                new OA\Property(property: 'name', type: 'string', example: 'COMPANIES'),
                new OA\Property(property: 'value', type: 'object', properties: [
                    new OA\Property(property: 'region', type: 'array', items: new OA\Items(type: 'object', properties: [
                        new OA\Property(property: 'regCode', type: 'string', example: '001'),
                        new OA\Property(property: 'regName', type: 'string', example: 'LATAM'),
                    ])),
                    new OA\Property(property: 'branch', type: 'array', items: new OA\Items(type: 'object', properties: [
                        new OA\Property(property: 'brcCode', type: 'string', example: '5300'),
                        new OA\Property(property: 'brcName', type: 'string', example: 'ALIMENTOS POLAR CHILE SPA'),
                        new OA\Property(property: 'brcGeneralHeader1', type: 'string', example: 'ALIMENTOS POLAR CHILE SPA'),
                        new OA\Property(property: 'regCode', type: 'string', example: '001'),
                    ])),
                    new OA\Property(property: 'login', type: 'array', items: new OA\Items(type: 'object', properties: [
                        new OA\Property(property: 'lgnCode', type: 'string', example: 'PC7818'),
                        new OA\Property(property: 'lgnName', type: 'string', example: 'CLAUDIO SALVATIERRA'),
                        new OA\Property(property: 'brcCode', type: 'string', example: '5300'),
                    ])),
                    new OA\Property(property: 'territory', type: 'array', items: new OA\Items(type: 'object', properties: [
                        new OA\Property(property: 'tryCode', type: 'string', example: 'CS01-CH01CS1'),
                        new OA\Property(property: 'brcCode', type: 'string', example: '5300'),
                        new OA\Property(property: 'lgnCode', type: 'string', example: 'PC1444'),
                        new OA\Property(property: 'tryName', type: 'string', example: 'Moderno 1-Oficina Santiago'),
                    ])),
                    new OA\Property(property: 'loginBranch', type: 'array', items: new OA\Items(type: 'object', properties: [
                        new OA\Property(property: 'lgnCode', type: 'string', example: 'PC0047'),
                        new OA\Property(property: 'brcCode', type: 'string', example: '5300'),
                    ])),
                    new OA\Property(property: 'crewLogin', type: 'array', items: new OA\Items(type: 'object', properties: [
                        new OA\Property(property: 'crwCode', type: 'string', example: 'PAN'),
                        new OA\Property(property: 'lgnCode', type: 'string', example: 'PC7391'),
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
                        new OA\Property(property: 'message', type: 'string', example: 'Master Company: 42 procesado(s), 0 omitido(s), 5 duplicado(s) eliminado(s)'),
                        new OA\Property(property: 'data', type: 'object', properties: [
                            new OA\Property(property: 'summary', type: 'object', properties: [
                                new OA\Property(property: 'total_processed', type: 'integer', example: 42),
                                new OA\Property(property: 'total_skipped', type: 'integer', example: 0),
                                new OA\Property(property: 'total_duplicates', type: 'integer', example: 5),
                            ]),
                            new OA\Property(property: 'detail', type: 'object', properties: [
                                new OA\Property(property: 'region', type: 'object', properties: [
                                    new OA\Property(property: 'processed', type: 'integer', example: 1),
                                    new OA\Property(property: 'skipped', type: 'integer', example: 0),
                                    new OA\Property(property: 'duplicates_removed', type: 'integer', example: 0),
                                ]),
                                new OA\Property(property: 'branch', type: 'object', properties: [
                                    new OA\Property(property: 'processed', type: 'integer', example: 1),
                                    new OA\Property(property: 'skipped', type: 'integer', example: 0),
                                    new OA\Property(property: 'duplicates_removed', type: 'integer', example: 0),
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
    public function masterCompany() {}

    // ═══════════════════════════════════════════════
    //  TRUNCATE COMPANIES
    // ═══════════════════════════════════════════════
    #[OA\Delete(
        path: '/truncate-companies',
        summary: 'Vaciar todas las tablas organizacionales (Regiones, Sucursales, Logins, Territorios)',
        tags: ['Cargas Masivas - MasterCompany'],
        security: [['sanctum' => []]],
        responses: [
            new OA\Response(response: 200, description: 'Tablas vaciadas exitosamente'),
            new OA\Response(response: 500, description: 'Error al vaciar las tablas')
        ]
    )]
    public function truncateCompanies() {}
}
