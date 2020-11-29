<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class DiaryStoreRequest extends FormRequest
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
        if (!is_null($this->category_id)) {
            return [
                'dni' => 'required|string|min:2|max:11',
                'verify_digit' => 'required|string|min:1|max:1',
                'name' => 'required|string|min:2|max:191',
                'lastname' => 'required|string|min:2|max:191',
                'phone' => 'required|string|min:5|max:15',
                'gender' => 'required|'.Rule::in(["Masculino", "Femenino"]),
                'birthday' => 'required|date',
                'email' => 'required|string|email|max:191',
                'date' => 'required|date',
                'time' => 'required|string',
                'service_id' => 'required',
                'category_id' => 'required',
                'subcategory_id' => 'required'
            ];
        } elseif (!is_null($this->specialty_id)) {
            return [
                'dni' => 'required|string|min:2|max:11',
                'verify_digit' => 'required|string|min:1|max:1',
                'name' => 'required|string|min:2|max:191',
                'lastname' => 'required|string|min:2|max:191',
                'phone' => 'required|string|min:5|max:15',
                'gender' => 'required|'.Rule::in(["Masculino", "Femenino"]),
                'birthday' => 'required|date',
                'email' => 'required|string|email|max:191',
                'date' => 'required|date',
                'time' => 'required|string',
                'service_id' => 'required',
                'specialty_id' => 'required',
                'doctor_id' => 'required'
            ];
        }
    }
}
