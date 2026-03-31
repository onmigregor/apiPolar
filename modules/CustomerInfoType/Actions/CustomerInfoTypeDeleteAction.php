<?php

namespace Modules\CustomerInfoType\Actions;

use Modules\CustomerInfoType\Models\CustomerInfoType;

class CustomerInfoTypeDeleteAction
{
    public function execute(CustomerInfoType $customerInfoType): void
    {
        $customerInfoType->delete();
    }
}
