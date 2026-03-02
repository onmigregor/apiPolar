<?php

namespace Modules\Journey\Actions;

use Modules\Journey\Models\Journey;

class JourneyDeleteAction
{
    public function execute(Journey $journey): void
    {
        $journey->delete();
    }
}
