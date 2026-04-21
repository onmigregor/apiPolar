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
        'rot_code'      => ['rotCode', 'ROT_CODE', 'rot_code'],
        'cus_code'      => ['cusCode', 'CUS_CODE', 'cus_code'],
        'fre_code'      => ['freCode', 'FRE_CODE', 'fre_code'],
        'ctr_monday'    => ['ctrMonday', 'CTR_MONDAY', 'ctr_monday'],
        'ctr_tuesday'   => ['ctrTuesday', 'CTR_TUESDAY', 'ctr_tuesday'],
        'ctr_wednesday' => ['ctrWednesday', 'CTR_WEDNESDAY', 'ctr_wednesday'],
        'ctr_thursday'  => ['ctrThursday', 'CTR_THURSDAY', 'ctr_thursday'],
        'ctr_friday'    => ['ctrFriday', 'CTR_FRIDAY', 'ctr_friday'],
        'ctr_saturday'  => ['ctrSaturday', 'CTR_SATURDAY', 'ctr_saturday'],
        'ctr_sunday'    => ['ctrSunday', 'CTR_SUNDAY', 'ctr_sunday'],
    ];
}
