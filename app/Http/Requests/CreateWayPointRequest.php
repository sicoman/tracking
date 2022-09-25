<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateWayPointRequest extends FormRequest
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
            'driver_id' => ['required'],
            'locations' => ['required'],
            'locations.*.lat' => ['required', 'numeric', 'min:-90', 'max:90'],
            'locations.*.lng' => ['required', 'numeric', 'min:-180', 'max:180'],
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
            'locations.required' => __('validation.required')
        ];
    }
}
