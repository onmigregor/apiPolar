<?php

namespace Modules\Unit\Actions;

use Modules\Unit\DataTransferObjects\UnitData;
use Modules\Unit\Models\Unit;

class UnitUpdateAction
{
    public function execute(Unit $unit, UnitData $data): Unit
    {
        $unit->update([
            'unt_code' => $data->unt_code,
            'unt_name' => $data->unt_name,
            'unt_nick' => $data->unt_nick,
        ]);

        return $unit->fresh();
    }
}
