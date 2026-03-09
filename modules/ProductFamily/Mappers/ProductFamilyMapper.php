<?php

namespace Modules\ProductFamily\Mappers;

class ProductFamilyMapper
{
    /**
     * Mapa de campos: snake_case (BD) => [posibles llaves de entrada].
     */
    public static array $map = [
        'cl1_code' => ['cl1Code', 'CL1_CODE', 'cl1_code', 'cl1code'],
        'cl1_name' => ['cl1Name', 'CL1_NAME', 'cl1_name', 'cl1name'],
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
