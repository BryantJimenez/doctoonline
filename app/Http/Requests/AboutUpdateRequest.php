<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AboutUpdateRequest extends FormRequest
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
            'banner' => 'nullable|file|mimetypes:image/*',
            'about' => 'nullable|string|min:5|max:64000',
            'mission' => 'nullable|string|min:5|max:64000',
            'vision' => 'nullable|string|min:5|max:64000'
        ];
    }
}
