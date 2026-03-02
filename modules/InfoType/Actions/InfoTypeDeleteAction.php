<?php

namespace Modules\InfoType\Actions;

use Modules\InfoType\Models\InfoType;

class InfoTypeDeleteAction
{
    public function execute(InfoType $infoType): void
    {
        $infoType->delete();
    }
}
