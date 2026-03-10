<?php

namespace Modules\RouteAssetType\Mappers;

use App\Traits\HasMapperTransform;

class RouteAssetTypeMapper
{
    use HasMapperTransform;

    /**
     * Mapa de campos: snake_case (BD) => [posibles llaves de entrada].
     */
    public static array $map = [
        'rot_code' => ['rotCode', 'ROT_CODE', 'rot_code'],
        'att_code' => ['attCode', 'ATT_CODE', 'att_code'],
    ];
}
