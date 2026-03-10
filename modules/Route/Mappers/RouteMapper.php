<?php

namespace Modules\Route\Mappers;

use App\Traits\HasMapperTransform;

class RouteMapper
{
    use HasMapperTransform;

    /**
     * Mapa de campos: snake_case (BD) => [posibles llaves de entrada].
     */
    public static array $map = [
        'rot_code' => ['rotCode', 'ROT_CODE', 'rot_code'],
        'rot_name' => ['rotName', 'ROT_NAME', 'rot_name'],
        'lgn_code' => ['lgnCode', 'LGN_CODE', 'lgn_code'],
        'try_code' => ['tryCode', 'TRY_CODE', 'try_code'],
    ];
}
