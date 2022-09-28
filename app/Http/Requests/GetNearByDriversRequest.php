<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GetNearByDriversRequest extends FormRequest
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
            'min_distance' => ['required', 'numeric'],
            'max_distance' => ['required', 'numeric'],
            'lat' => ['required', 'numeric', 'min:-90', 'max:90'],
            'lng' => ['required', 'numeric', 'min:-180', 'max:180'],
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
            'min_distance.required' => __('validation.required'),
            'min_distance.numeric' => __('validation.numeric'),
            'max_distance.required' => __('validation.required'),
            'max_distance.numeric' => __('validation.numeric'),
            'lat.required' => __('validation.required'),
            'lng.required' => __('validation.required'),
            'lat.numeric' => __('validation.numeric'),
            'lng.numeric' => __('validation.numeric'),
            'lat.min' => __('validation.min'),
            'lng.min' => __('validation.min'),
            'lat.max' => __('validation.max'),
            'lng.max' => __('validation.max'),
        ];
    }
}
