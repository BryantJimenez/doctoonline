<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ServiceStoreRequest extends FormRequest
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
            'image' => 'required|file|mimetypes:image/*',
            'banner' => 'required|file|mimetypes:image/*',
            'title' => 'required|string|min:2|max:191',
            'description' => 'required|string|min:2|max:16770000',
            'icon' => 'required|file|mimetypes:image/*',
            'line' => 'required|string|min:2|max:191',
            'diary_title' => 'required|string|min:2|max:191',
            'diary_description' => 'required|string|min:2|max:16770000',
            'app_title' => 'required|string|min:2|max:191',
            'app_description' => 'required|string|min:2|max:16770000',
            'featured' => 'required|'.Rule::in([0, 1]),
            'type' => 'required|'.Rule::in([1, 2])
        ];
    }
}
