<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class RegisterCustomRequest extends FormRequest
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
            'dni' => 'required|string|min:2|max:11',
            'verify_digit' => 'required|string|min:1|max:1',
            'name' => 'required|string|min:2|max:191',
            'first_lastname' => 'required|string|min:2|max:191',
            'second_lastname' => 'required|string|min:2|max:191',
            'gender' => 'required|'.Rule::in(["Masculino", "Femenino"]),
            'country_id' => 'required',
            'commune_id' => 'required',
            'birthday' => 'required|date',
            'email' => 'required|string|email|max:191|unique:people,email',
            'password' => 'required|string|min:8',
            'terms' => 'required'
        ];
    }
}
