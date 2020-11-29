<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PatientUpdateRequest extends FormRequest
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
      'civil_state' => 'required|'.Rule::in(["Soltero", "Casado"]),
      'laboral' => 'required|'.Rule::in(["Empleado", "Cesante", "Jubilado"]),
      'study_id' => 'required',
      'insurer_id' => 'required',
      'children' => 'nullable|integer|min:1|max:99',
      'password' => 'nullable|string|min:8|confirmed'
    ];
  }
}
