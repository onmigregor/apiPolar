<?php

namespace Modules\CustomerRoute\Mappers;

use App\Traits\HasMapperTransform;

class CustomerRouteMapper
{
    use HasMapperTransform;

    /**
     * Mapa de campos: snake_case (BD) => [posibles llaves de entrada].
     */
    public static array $map = [
        'rot_code'      => ['rotCode'],
        'cus_code'      => ['cusCode'],
        'fre_code'      => ['freCode'],
        'ctr_monday'    => ['ctrMonday'],
        'ctr_tuesday'   => ['ctrTuesday'],
        'ctr_wednesday' => ['ctrWednesday'],
        'ctr_thursday'  => ['ctrThursday'],
        'ctr_friday'    => ['ctrFriday'],
    ];
}
