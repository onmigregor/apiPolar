<?php

namespace Modules\Unit\Actions;

use Modules\Unit\DataTransferObjects\UnitData;
use Modules\Unit\Models\Unit;

class UnitStoreAction
{
    public function execute(UnitData $data): Unit
    {
        return Unit::create([
            'unt_code' => $data->unt_code,
            'unt_name' => $data->unt_name,
            'unt_nick' => $data->unt_nick,
        ]);
    }
}
