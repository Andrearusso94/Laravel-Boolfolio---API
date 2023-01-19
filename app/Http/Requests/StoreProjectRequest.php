<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required|unique:projects|max:50',
            'cover_image' => 'required|image|max:250',
            'type_id' => 'nullable|exists:type,id',
            'technology_id' => 'exists:technology,id',
            'body' => 'nullable',
        ];
    }
}
