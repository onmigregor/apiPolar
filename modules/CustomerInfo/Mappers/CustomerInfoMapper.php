<?php

namespace Modules\CustomerInfo\Mappers;

class CustomerInfoMapper
{
    /**
     * Mapa de campos: snake_case (BD) => [posibles llaves de entrada].
     */
    public static array $map = [
        'cus_code'       => ['cusCode', 'CUS_CODE', 'cus_code'],
        'ift_code'       => ['iftCode', 'IFT_CODE', 'ift_code'],
        'ctn_char_value' => ['ctnCharValue', 'CTN_CHAR_VALUE', 'ctn_char_value'],
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
