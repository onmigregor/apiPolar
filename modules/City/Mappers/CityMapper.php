<?php

namespace Modules\City\Mappers;

class CityMapper
{
    /**
     * Mapa de campos: snake_case (BD) => [posibles llaves de entrada].
     */
    public static array $map = [
        'cit_code' => ['citCode', 'CIT_CODE', 'cit_code'],
        'cit_name' => ['citName', 'CIT_NAME', 'cit_name'],
        'sta_code' => ['staCode', 'STA_CODE', 'sta_code'],
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
