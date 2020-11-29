<?php

namespace App\Http\Requests;

use App\Service;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class DiaryTwoStoreRequest extends FormRequest
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
        $service=Service::where('slug', $this->service_id)->firstOrFail();
        if ($service->type==2) {
            return [
                'service_id' => 'required',
                'category_id' => 'required',
                'subcategory_id' => 'required'
            ];
        } else {
            return [
                'service_id' => 'required',
                'specialty_id' => 'required',
                'doctor_id' => 'required'
            ];
        }
    }
}
