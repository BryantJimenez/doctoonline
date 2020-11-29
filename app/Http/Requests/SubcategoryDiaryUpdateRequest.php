<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubcategoryDiaryUpdateRequest extends FormRequest
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
            'name' => 'required|string|min:2|max:191',
            'code' => 'required|string|min:2|max:191',
            'service_id' => 'required|array',
            'service' => 'required|array',
            'price' => 'required|array',
            'day' => 'required|array',
            'start' => 'required|array',
            'end' => 'required|array',
            'category_id' => 'required'
        ];
    }
}
