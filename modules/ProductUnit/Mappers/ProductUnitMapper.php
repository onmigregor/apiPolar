<?php

namespace Modules\ProductUnit\Mappers;

class ProductUnitMapper
{
    /**
     * Mapa de campos: snake_case (BD) => [posibles llaves de entrada].
     */
    public static array $map = [
        'pro_code'      => ['proCode', 'PRO_CODE', 'pro_code'],
        'unt_code'      => ['untCode', 'UNT_CODE', 'unt_code'],
        'pru_divide_by' => ['pruDivideBy', 'PRU_DIVIDE_BY', 'pru_divide_by'],
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
