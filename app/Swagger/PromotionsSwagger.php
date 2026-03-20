<?php

namespace App\Swagger;

use OpenApi\Attributes as OA;

class PromotionsSwagger
{
    // ═══════════════════════════════════════════════
    //  MASTER PROMOTION (bulk) — Formato Polar
    // ═══════════════════════════════════════════════
    #[OA\Post(path: '/masterpromotion', summary: 'Carga masiva de datos maestros de promociones (formato Polar)', tags: ['Cargas Masivas - MasterPromotion'],
        security: [['sanctum' => []]],
        requestBody: new OA\RequestBody(required: true, content: new OA\JsonContent(
            type: 'array',
            items: new OA\Items(type: 'object', properties: [
                new OA\Property(property: 'name', type: 'string', example: 'PROMOTIONS'),
                new OA\Property(property: 'value', type: 'object', properties: [
                    new OA\Property(property: 'promotion', type: 'array', items: new OA\Items(type: 'object', properties: [
                        new OA\Property(property: 'prmCode', type: 'string', example: 'PMIC-C001/C3C'),
                        new OA\Property(property: 'prmName', type: 'string', example: 'PromoMarca.Inme.Cant-Ventas Nacionales'),
                    ])),
                    new OA\Property(property: 'promotionDetail', type: 'array', items: new OA\Items(type: 'object', properties: [
                        new OA\Property(property: 'pdlCode', type: 'string', example: '0000073281-1-1'),
                        new OA\Property(property: 'prmCode', type: 'string', example: 'PMIC-C001/C3C'),
                        new OA\Property(property: 'pdlName', type: 'string', example: 'Plan tactico ta'),
                        new OA\Property(property: 'pdlSince', type: 'string', example: '2026-03-12'),
                        new OA\Property(property: 'pdlUntil', type: 'string', example: '2026-12-31T23:59:59'),
                        new OA\Property(property: 'cusCode', type: 'string', example: '0000054103'),
                    ])),
                    new OA\Property(property: 'promotionDetailProduct', type: 'array', items: new OA\Items(type: 'object', properties: [
                        new OA\Property(property: 'prpCode', type: 'string', example: '0000073281-1-11'),
                        new OA\Property(property: 'pdlCode', type: 'string', example: '0000073281-1-1'),
                        new OA\Property(property: 'prmCode', type: 'string', example: 'PMIC-C001/C3C'),
                        new OA\Property(property: 'proCode', type: 'string', example: 'F01001'),
                        new OA\Property(property: 'untCode', type: 'string', example: 'CJ'),
                        new OA\Property(property: 'prpQuantity1', type: 'number', example: 10.0),
                    ])),
                    new OA\Property(property: 'promotionRoute', type: 'array', items: new OA\Items(type: 'object', properties: [
                        new OA\Property(property: 'rotCode', type: 'string', example: '01191'),
                        new OA\Property(property: 'prmCode', type: 'string', example: 'PMIC-C001/C3C'),
                    ])),
                    new OA\Property(property: 'promotionTeam', type: 'array', items: new OA\Items(type: 'object', properties: [
                        new OA\Property(property: 'teaCode', type: 'string', example: '01'),
                        new OA\Property(property: 'prmCode', type: 'string', example: 'PMIC-C001/C3C'),
                    ])),
                ]),
            ])
        )),
        responses: [
            new OA\Response(response: 201, description: 'Registros procesados exitosamente'),
            new OA\Response(response: 422, description: 'Formato no reconocido'),
            new OA\Response(response: 500, description: 'Error en la carga masiva'),
        ]
    )]
    public function masterPromotion() {}
}
