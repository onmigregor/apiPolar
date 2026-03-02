<?php

namespace Modules\Route\Mappers;

class RouteMapper
{
    /**
     * Mapa de campos: snake_case (BD) => [posibles llaves de entrada].
     */
    public static array $map = [
        'rot_code' => ['rotCode', 'ROT_CODE', 'rot_code'],
        'rot_name' => ['rotName', 'ROT_NAME', 'rot_name'],
        'lgn_code' => ['lgnCode', 'LGN_CODE', 'lgn_code'],
        'try_code' => ['tryCode', 'TRY_CODE', 'try_code'],
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
