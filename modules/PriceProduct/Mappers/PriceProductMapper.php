<?php

namespace Modules\PriceProduct\Mappers;

class PriceProductMapper
{
    /**
     * Mapa de campos: snake_case (BD) => [posibles llaves de entrada].
     */
    public static array $map = [
        'prc_code'         => ['prcCode', 'PRC_CODE', 'prc_code'],
        'pro_code'         => ['proCode', 'PRO_CODE', 'pro_code'],
        'unt_code'         => ['untCode', 'UNT_CODE', 'unt_code'],
        'ppr_date1'        => ['pprDate1', 'PPR_DATE1', 'ppr_date1'],
        'ppr_price1_date1' => ['pprPrice1Date1', 'PPR_PRICE1_DATE1', 'ppr_price1_date1'],
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
