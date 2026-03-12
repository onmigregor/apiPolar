<?php

namespace Modules\ProductClass3\Mappers;

use App\Traits\HasMapperTransform;

class ProductClass3Mapper
{
    use HasMapperTransform;

    public static array $map = [
        'cl3_code' => ['cl3code', 'cl3_code', 'CL3_CODE'],
        'cl3_name' => ['cl3name', 'cl3_name', 'CL3_NAME'],
        'cl2_code' => ['cl2code', 'cl2_code', 'CL2_CODE'],
    ];

    /**
     * Sobrescribimos transform para intentar inferir cl2_code si no viene.
     */
    public static function transform(array $data): array
    {
        $transformed = self::transformBasic($data);

        // Si no viene cl2_code pero tenemos cl3_code, intentamos inferir el padre.
        // Ejemplo Polar: cl3code "NAACFHC89 M211PR" -> cl2code es "NAACFHC89"
        if (empty($transformed['cl2_code']) && !empty($transformed['cl3_code'])) {
            $parts = explode(' ', $transformed['cl3_code']);
            if (count($parts) > 1) {
                $transformed['cl2_code'] = $parts[0];
            }
        }

        return $transformed;
    }

    private static function transformBasic(array $data): array
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
