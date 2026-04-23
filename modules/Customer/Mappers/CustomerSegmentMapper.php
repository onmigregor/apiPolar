<?php
namespace Modules\Customer\Mappers;

class CustomerSegmentMapper
{
    public static function transform(array $data): array
    {
        return [
            'tp3_code' => $data['tp3code'] ?? null,
            'tp3_name' => $data['tp3name'] ?? null,
        ];
    }
}
