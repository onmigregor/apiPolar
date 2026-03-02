<?php

namespace Modules\Taxation\Actions;

use Modules\Taxation\Models\Taxation;

class TaxationDeleteAction
{
    public function execute(Taxation $taxation): void
    {
        $taxation->delete();
    }
}
