<?php

namespace Modules\PromotionDetail\DataTransferObjects;

class PromotionDetailData
{
    public function __construct(
        public string $pdlCode,
        public string $prmCode,
        public ?string $pdlName = null,
        public ?string $pdlSince = null,
        public ?string $pdlUntil = null,
        public ?string $cusCode = null
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            pdlCode: $data['pdlCode'] ?? '',
            prmCode: $data['prmCode'] ?? '',
            pdlName: $data['pdlName'] ?? null,
            pdlSince: $data['pdlSince'] ?? null,
            pdlUntil: $data['pdlUntil'] ?? null,
            cusCode: $data['cusCode'] ?? null
        );
    }
}
