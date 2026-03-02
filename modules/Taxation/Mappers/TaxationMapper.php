<?php

namespace Modules\Taxation\Mappers;

class TaxationMapper
{
    /**
     * Mapa de campos: snake_case (BD) => [posibles llaves de entrada].
     */
    public static array $map = [
        'txn_code' => ['txnCode', 'TXN_CODE', 'txn_code'],
        'txn_name' => ['txnName', 'TXN_NAME', 'txn_name'],
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
