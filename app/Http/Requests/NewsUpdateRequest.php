<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class NewsUpdateRequest extends FormRequest
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
            'title' => 'required|string|min:2|max:191',
            'image' => 'nullable|file|mimetypes:image/*',
            'content' => 'required|string|min:2|max:16770000',
            'category_id' => 'required|array',
            'featured' => 'required|'.Rule::in([0, 1]),
            'state' => 'required|'.Rule::in([1, 2])
        ];
    }
}
