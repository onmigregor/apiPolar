<?php

namespace Modules\Route\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RouteResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'       => $this->id,
            'rot_code' => $this->rot_code,
            'rot_name' => $this->rot_name,
            'lgn_code' => $this->lgn_code,
            'try_code' => $this->try_code,
        ];
    }
}
