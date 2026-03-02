<?php

namespace Modules\CustomerGroup\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerGroupResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'       => $this->id,
            'tp1_code' => $this->tp1_code,
            'tp1_name' => $this->tp1_name,
        ];
    }
}
