<?php

namespace Modules\PromotionDetail\Mappers;

use App\Traits\HasMapperTransform;

class PromotionDetailMapper
{
    use HasMapperTransform;

    public static array $map = [
        'pdl_code'  => ['pdlCode', 'pdl_code', 'PDLCODE'],
        'prm_code'  => ['prmCode', 'prm_code', 'PRMCODE'],
        'pdl_name'  => ['pdlName', 'pdl_name', 'PDLNAME'],
        'pdl_since' => ['pdlSince', 'pdl_since', 'PDLSINCE'],
        'pdl_until' => ['pdlUntil', 'pdl_until', 'PDLUNTIL'],
        'cus_code'  => ['cusCode', 'cus_code', 'CUSCODE'],
    ];

    /**
     * Override transform to handle special T in dates and nulls
     */
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

            // Clean date fields
            if (($resolved === 'pdl_since' || $resolved === 'pdl_until') && is_string($value)) {
                $value = str_replace('T', ' ', $value);
            }

            $mapped[$resolved] = $value;
        }

        return $mapped;
    }
}
