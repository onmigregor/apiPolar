<?php

namespace Modules\RouteGeneral\Mappers;

use App\Traits\HasMapperTransform;

class RouteGeneralMapper
{
    use HasMapperTransform;

    /**
     * Mapa de campos: snake_case (BD) => [posibles llaves de entrada].
     */
    public static array $map = [
        'rot_code'               => ['rotCode', 'ROT_CODE', 'rot_code'],
        'gnl_date'               => ['gnlDate', 'GNL_DATE', 'gnl_date'],
        'gnl_month_working_days' => ['gnlMonthWorkingDays', 'GNL_MONTH_WORKING_DAYS', 'gnl_month_working_days'],
        'gnl_days_up_to_date'    => ['gnlDaysUpToDate', 'GNL_DAYS_UP_TO_DATE', 'gnl_days_up_to_date'],
        'gnl_next_working_day'   => ['gnlNextWorkingDay', 'GNL_NEXT_WORKING_DAY', 'gnl_next_working_day'],
        'jrn_code'               => ['jrnCode', 'JRN_CODE', 'jrn_code'],
        'gnl_status'             => ['gnlStatus', 'GNL_STATUS', 'gnl_status'],
        'gnl_status_date'        => ['gnlStatusDate', 'GNL_STATUS_DATE', 'gnl_status_date'],
    ];
}
