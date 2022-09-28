<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GetRouteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'driver_id' => ['required', 'integer'],
            'start_time' => ['required', 'date_format:Y-m-d H:i:s'],
            'end_time' => ['required', 'date_format:Y-m-d H:i:s']
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'driver_id.required' => __('validation.required'),
            'driver_id.integer' => __('validation.integer'),
            'start_time.required' => __('validation.required'),
            'start_time.date_format' => __('validation.date_format'),
            'end_time.required' => __('validation.required'),
            'end_time.date_format' => __('validation.date_format'),
        ];
    }
}
