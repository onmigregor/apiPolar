<?php

namespace Modules\CustomerFrequency\Mappers;

use App\Traits\HasMapperTransform;

class CustomerFrequencyMapper
{
    use HasMapperTransform;

    /**
     * Mapa de campos: snake_case (BD) => [posibles llaves de entrada].
     */
    public static array $map = [
        'fre_code'     => ['freCode'],
        'fre_name'     => ['freName'],
        'fre_week1'    => ['freWeek1'],
        'fre_week2'    => ['freWeek2'],
        'fre_week3'    => ['freWeek3'],
        'fre_week4'    => ['freWeek4'],
        'fre_customer' => ['freCustomer'],
    ];
}
