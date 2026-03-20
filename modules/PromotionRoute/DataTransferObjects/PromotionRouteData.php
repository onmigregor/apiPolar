<?php

namespace Modules\PromotionRoute\DataTransferObjects;

class PromotionRouteData
{
    public function __construct(
        public string $rotCode,
        public string $prmCode
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            rotCode: $data['rotCode'] ?? '',
            prmCode: $data['prmCode'] ?? ''
        );
    }
}
