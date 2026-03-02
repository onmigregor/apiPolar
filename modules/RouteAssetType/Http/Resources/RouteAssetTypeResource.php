<?php

namespace Modules\RouteAssetType\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RouteAssetTypeResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'       => $this->id,
            'rot_code' => $this->rot_code,
            'att_code' => $this->att_code,
        ];
    }
}
