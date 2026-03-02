<?php

namespace Modules\CustomerFrequency\Mappers;

class CustomerFrequencyMapper
{
    /**
     * Mapa de campos: snake_case (BD) => [posibles llaves de entrada].
     */
    public static array $map = [
        'fre_code'     => ['freCode'],
        'fre_name'     => ['freName'],
        'fre_week1'    => ['freWeek1'],
        'fre_week2'    => ['freWeek2'],
        'fre_week3'    => ['freWeek3'],
        'fre_week4'    => ['freWeek4'],
        'fre_customer' => ['freCustomer'],
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
