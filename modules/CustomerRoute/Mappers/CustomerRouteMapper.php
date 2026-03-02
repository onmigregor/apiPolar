<?php

namespace Modules\CustomerRoute\Mappers;

class CustomerRouteMapper
{
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

    public static function transform(array $data): array
    {
        $mapped = [];

        foreach ($data as $key => $value) {
            $resolved = $key;

            foreach (self::$map as $target => $aliases) {
                if (in_array($key, $aliases, true)) {
                    $resolved = $target;
                    break;
                }
            }

            $mapped[$resolved] = $value;
        }

        return $mapped;
    }
}
