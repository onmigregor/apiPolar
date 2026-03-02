<?php

namespace Modules\Unit\Mappers;

class UnitMapper
{
    /**
     * Mapa de campos: snake_case (BD) => [posibles llaves de entrada].
     */
    public static array $map = [
        'unt_code' => ['untCode', 'UNT_CODE', 'unt_code'],
        'unt_name' => ['untName', 'UNT_NAME', 'unt_name'],
        'unt_nick' => ['untNick', 'UNT_NICK', 'unt_nick'],
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
