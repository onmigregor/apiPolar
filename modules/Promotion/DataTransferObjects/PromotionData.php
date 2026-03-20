<?php

namespace Modules\Promotion\DataTransferObjects;

class PromotionData
{
    public function __construct(
        public string $prmCode,
        public ?string $prmName = null
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            prmCode: $data['prmCode'] ?? '',
            prmName: $data['prmName'] ?? null
        );
    }
}
