<?php

namespace Modules\Unit\Mappers;

use App\Traits\HasMapperTransform;

class UnitMapper
{
    use HasMapperTransform;

    /**
     * Mapa de campos: snake_case (BD) => [posibles llaves de entrada].
     */
    public static array $map = [
        'unt_code' => ['untCode', 'UNT_CODE', 'unt_code'],
        'unt_name' => ['untName', 'UNT_NAME', 'unt_name'],
        'unt_nick' => ['untNick', 'UNT_NICK', 'unt_nick'],
    ];
}

