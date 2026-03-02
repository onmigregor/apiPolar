<?php

namespace Modules\InfoType\Mappers;

class InfoTypeMapper
{
    /**
     * Mapa de campos: snake_case (BD) => [posibles llaves de entrada].
     */
    public static array $map = [
        'ift_code'      => ['iftCode', 'IFT_CODE', 'ift_code'],
        'ift_name'      => ['iftName', 'IFT_NAME', 'ift_name'],
        'ift_char_type' => ['iftCharType', 'IFT_CHAR_TYPE', 'ift_char_type'],
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
