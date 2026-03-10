<?php

namespace Modules\Journey\Mappers;

use App\Traits\HasMapperTransform;

class JourneyMapper
{
    use HasMapperTransform;

    /**
     * Mapa de campos: snake_case (BD) => [posibles llaves de entrada].
     */
    public static array $map = [
        'jrn_code'   => ['jrnCode', 'JRN_CODE', 'jrn_code'],
        'rot_code'   => ['rotCode', 'ROT_CODE', 'rot_code'],
        'jrn_date'   => ['jrnDate', 'JRN_DATE', 'jrn_date'],
        'jrn_dummy'  => ['jrnDummy', 'JRN_DUMMY', 'jrn_dummy'],
        'jrn_status' => ['jrnStatus', 'JRN_STATUS', 'jrn_status'],
    ];
}
