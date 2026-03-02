<?php

namespace Modules\RouteGeneral\Mappers;

class RouteGeneralMapper
{
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

    public static function transform(array $data): array
    {
        $mapped = [];

        foreach ($data as $key => $value) {
            $resolved = $key;

            foreach (self::$map as $target => $aliases) {
                if (in_array($key, $aliases, true)) {
                    $resolved = $target;
                    break;
                }
            }

            $mapped[$resolved] = $value;
        }

        return $mapped;
    }
}
