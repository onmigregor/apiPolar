<?php

namespace Modules\RouteGeneral\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\RouteGeneral\Mappers\RouteGeneralMapper;

class RouteGeneralRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge(
            RouteGeneralMapper::transform($this->all())
        );
    }

    public function rules()
    {
        return [
            'rot_code'               => ['required', 'string', 'max:6'],
            'gnl_date'               => ['nullable', 'date'],
            'gnl_month_working_days' => ['nullable', 'integer'],
            'gnl_days_up_to_date'    => ['nullable', 'integer'],
            'gnl_next_working_day'   => ['nullable', 'string', 'max:20'],
            'jrn_code'               => ['nullable', 'string', 'max:10'],
            'gnl_status'             => ['nullable', 'string', 'max:20'],
            'gnl_status_date'        => ['nullable', 'date'],
        ];
    }
}
