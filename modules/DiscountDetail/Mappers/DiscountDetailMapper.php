<?php

namespace Modules\DiscountDetail\Mappers;

class DiscountDetailMapper
{
    /**
     * Mapa de campos: snake_case (BD) => [posibles llaves de entrada].
     */
    public static array $map = [
        'dis_code'          => ['disCode', 'DIS_CODE', 'dis_code'],
        'did_code'          => ['didCode', 'DID_CODE', 'did_code'],
        'did_name'          => ['didName', 'DID_NAME', 'did_name'],
        'rot_code_customer' => ['rotCodeCustomer', 'ROTCODECUSTOMER', 'ROT_CODE_CUSTOMER', 'rot_code_customer'],
        'cus_code'          => ['cusCode', 'CUS_CODE', 'cus_code'],
        'did_since'         => ['didSince', 'DID_SINCE', 'did_since'],
        'did_until'         => ['didUntil', 'DID_UNTIL', 'did_until'],
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
