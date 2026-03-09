<?php

namespace Modules\ProductCategory\Mappers;

class ProductCategoryMapper
{
    public static array $map = [
        'cl2_code' => ['cl2Code', 'CL2_CODE', 'cl2_code', 'cl2code'],
        'cl1_code' => ['cl1Code', 'CL1_CODE', 'cl1_code', 'cl1code'],
        'cl2_name' => ['cl2Name', 'CL2_NAME', 'cl2_name', 'cl2name'],
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
