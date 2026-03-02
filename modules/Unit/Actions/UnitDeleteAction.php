<?php

namespace Modules\Unit\Actions;

use Modules\Unit\Models\Unit;

class UnitDeleteAction
{
    public function execute(Unit $unit): void
    {
        $unit->delete();
    }
}
