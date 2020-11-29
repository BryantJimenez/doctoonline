<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class DiaryDoctorUpdateRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'description' => 'required|string|min:2|max:1000',
            'rating' => 'required|'.Rule::in([1, 2, 3, 4, 5]),
            'url' => 'nullable|string|min:2|max:191',
            'service_id' => 'required|array',
            'service' => 'required|array',
            'price' => 'required|array',
            'day' => 'required|array',
            'start' => 'required|array',
            'end' => 'required|array'
        ];
    }
}
