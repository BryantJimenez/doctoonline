<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class DoctorStoreRequest extends FormRequest
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
    if ($this->slug==NULL) {
      return [
        'photo' => 'nullable|file|mimetypes:image/*',
        'dni' => 'required|string|min:2|max:11',
        'verify_digit' => 'required|string|min:1|max:1',
        'name' => 'required|string|min:2|max:191',
        'first_lastname' => 'required|string|min:2|max:191',
        'second_lastname' => 'required|string|min:2|max:191',
        'phone' => 'required|string|min:5|max:15',
        'celular' => 'required|string|min:5|max:15',
        'gender' => 'required|'.Rule::in(["Masculino", "Femenino"]),
        'country_id' => 'required',
        'commune_id' => 'required',
        'postal' => 'required|string|min:1|max:8',
        'address' => 'required|string|min:2|max:191',
        'birthday' => 'required|date',
        'email' => 'required|string|email|max:191|unique:people,email',
        'profession_id' => 'required',
        'number_doctor' => 'required|string|min:1|max:191',
        'inscription' => 'required|string|min:1|max:191',
        'signature' => 'required|file|mimetypes:image/*',
        'specialty_id' => 'required|array',
        'password' => 'required|string|min:8|confirmed'
      ];
    } else {
      return [
        'profession_id' => 'required',
        'number_doctor' => 'required|string|min:1|max:191',
        'inscription' => 'required|string|min:1|max:191',
        'signature' => 'required|file|mimetypes:image/*',
        'specialty_id' => 'required|array'
      ];
    }
  }
}
