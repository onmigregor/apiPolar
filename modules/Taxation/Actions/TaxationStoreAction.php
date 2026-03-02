<?php

namespace Modules\Taxation\Actions;

use Modules\Taxation\DataTransferObjects\TaxationData;
use Modules\Taxation\Models\Taxation;

class TaxationStoreAction
{
    public function execute(TaxationData $data): Taxation
    {
        return Taxation::create([
            'txn_code' => $data->txn_code,
            'txn_name' => $data->txn_name,
        ]);
    }
}
