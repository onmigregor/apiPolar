<?php

namespace Modules\CustomerFrequency\Actions;

use Modules\CustomerFrequency\Models\CustomerFrequency;

class CustomerFrequencyDeleteAction
{
    public function execute(CustomerFrequency $customerFrequency): void
    {
        $customerFrequency->delete();
    }
}
