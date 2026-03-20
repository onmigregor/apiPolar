<?php

namespace Modules\PromotionDetailProduct\DataTransferObjects;

class PromotionDetailProductData
{
    public function __construct(
        public string $prpCode,
        public string $pdlCode,
        public string $prmCode,
        public ?string $proCode = null,
        public ?string $untCode = null,
        public ?float $prpQuantity1 = null
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            prpCode: $data['prpCode'] ?? '',
            pdlCode: $data['pdlCode'] ?? '',
            prmCode: $data['prmCode'] ?? '',
            proCode: $data['proCode'] ?? null,
            untCode: $data['untCode'] ?? null,
            prpQuantity1: isset($data['prpQuantity1']) ? (float)$data['prpQuantity1'] : null
        );
    }
}
