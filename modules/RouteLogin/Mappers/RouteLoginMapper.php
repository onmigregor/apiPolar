<?php

namespace Modules\RouteLogin\Mappers;

use App\Traits\HasMapperTransform;

class RouteLoginMapper
{
    use HasMapperTransform;

    /**
     * Mapa de campos: snake_case (BD) => [posibles llaves de entrada].
     */
    public static array $map = [
        'rot_code' => ['rotCode', 'ROT_CODE', 'rot_code'],
        'lgn_code' => ['lgnCode', 'LGN_CODE', 'lgn_code'],
    ];
}
