<?php

namespace Modules\Unit\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UnitResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'       => $this->id,
            'unt_code' => $this->unt_code,
            'unt_name' => $this->unt_name,
            'unt_nick' => $this->unt_nick,
        ];
    }
}
