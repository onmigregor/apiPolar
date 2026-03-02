<?php

namespace Modules\InfoType\Actions;

use Modules\InfoType\DataTransferObjects\InfoTypeData;
use Modules\InfoType\Models\InfoType;

class InfoTypeUpdateAction
{
    public function execute(InfoType $infoType, InfoTypeData $data): InfoType
    {
        $infoType->update([
            'ift_code'      => $data->ift_code,
            'ift_name'      => $data->ift_name,
            'ift_char_type' => $data->ift_char_type,
        ]);

        return $infoType->fresh();
    }
}
