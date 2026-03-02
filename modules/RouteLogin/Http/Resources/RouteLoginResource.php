<?php

namespace Modules\RouteLogin\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RouteLoginResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'       => $this->id,
            'rot_code' => $this->rot_code,
            'lgn_code' => $this->lgn_code,
        ];
    }
}
