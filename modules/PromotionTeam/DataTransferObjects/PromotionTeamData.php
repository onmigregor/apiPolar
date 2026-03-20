<?php

namespace Modules\PromotionTeam\DataTransferObjects;

class PromotionTeamData
{
    public function __construct(
        public string $teaCode,
        public string $prmCode
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            teaCode: $data['teaCode'] ?? '',
            prmCode: $data['prmCode'] ?? ''
        );
    }
}
