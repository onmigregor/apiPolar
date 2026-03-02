<?php

namespace Modules\Tax\Actions;

use Modules\Tax\Models\Tax;

class TaxDeleteAction
{
    public function execute(Tax $tax): void
    {
        $tax->delete();
    }
}
