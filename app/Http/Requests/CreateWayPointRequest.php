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
            'locations.*.status' => ['required', 'in:Ideal,Riding,Waiting']
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
            'locations.required' => __('validation.required'),
            'locations.*.lat.required' => __('validation.required'),
            'locations.*.lng.required' => __('validation.required'),
            'locations.*.lat.numeric' => __('validation.numeric'),
            'locations.*.lng.numeric' => __('validation.numeric'),
            'locations.*.lat.min' => __('validation.min'),
            'locations.*.lng.min' => __('validation.min'),
            'locations.*.lat.max' => __('validation.max'),
            'locations.*.lng.max' => __('validation.max'),
            'locations.*.status.in' => __('validation.in'),
            'locations.*.status.required' => __('validation.required'),
        ];
    }
}
