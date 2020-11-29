<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ReportOneStoreRequest extends FormRequest
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
            'people_id' => 'required',
            'reason' => 'required|string|min:2|max:65000',
            'select_personal_history' => 'required|'.Rule::in(['No', 'Si']),
            'disease_personal' => 'nullable|array',
            'personal_history' => 'nullable|string|min:2|max:65000',
            'select_surgical_history' => 'required|'.Rule::in(['No', 'Si']),
            'surgicals' => 'nullable|array',
            'surgical_history' => 'nullable|string|min:2|max:65000',
            'select_family_history' => 'required|'.Rule::in(['No', 'Si']),
            'disease_family' => 'nullable|array',
            'family_history' => 'nullable|string|min:2|max:65000',
            'medicines' => 'nullable|string|min:2|max:65000',
            'foods' => 'nullable|string|min:2|max:65000',
            'others_allergies' => 'nullable|string|min:2|max:65000',
            'alcohol' => 'required|'.Rule::in(['No', 'Si']),
            'number_liters' => 'nullable|integer|min:1|max:999',
            'years_taker' => 'nullable|string|min:0|max:999',
            'tobacco' => 'required|'.Rule::in(['No', 'Si']),
            'number_cigarettes' => 'nullable|integer|min:1|max:999',
            'years_smoker' => 'nullable|integer|min:0|max:999',
            'drugs' => 'required|'.Rule::in(['No', 'Si']),
            'years_consumption' => 'nullable|integer|min:0|max:999',
            'indicate_drugs' => 'nullable|string|min:2|max:65000',
            'disease_current' => 'required|string|min:2|max:65000'
        ];
    }
}
