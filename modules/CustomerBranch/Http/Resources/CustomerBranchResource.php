<?php

namespace Modules\CustomerBranch\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerBranchResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'       => $this->id,
            'tp2_code' => $this->tp2_code,
            'tp2_name' => $this->tp2_name,
        ];
    }
}
