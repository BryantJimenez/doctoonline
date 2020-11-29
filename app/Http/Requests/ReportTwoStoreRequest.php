<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ReportTwoStoreRequest extends FormRequest
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
            'weight' => 'required|string|min:0',
            'height' => 'required|string|min:0',
            'temperature' => 'required|string|min:0',
            'systolic_pressure' => 'required|string|min:0',
            'dystolic_pressure' => 'required|string|min:0',
            'pulse' => 'required|string|min:0',
            'frequency' => 'required|string|min:0',
            'mucous' => 'nullable|string|min:2|max:65000',
            'head_neck' => 'nullable|string|min:2|max:65000',
            'respiratory' => 'nullable|string|min:2|max:65000',
            'cardiovascular' => 'nullable|string|min:2|max:65000',
            'abdomen' => 'nullable|string|min:2|max:65000',
            'others_exams' => 'nullable|string|min:2|max:65000'
        ];
    }
}
