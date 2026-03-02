<?php

namespace Modules\Taxation\Actions;

use Modules\Taxation\DataTransferObjects\TaxationData;
use Modules\Taxation\Models\Taxation;

class TaxationUpdateAction
{
    public function execute(Taxation $taxation, TaxationData $data): Taxation
    {
        $taxation->update([
            'txn_code' => $data->txn_code,
            'txn_name' => $data->txn_name,
        ]);

        return $taxation->fresh();
    }
}
