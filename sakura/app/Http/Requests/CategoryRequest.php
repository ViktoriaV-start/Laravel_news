<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class CategoryRequest extends FormRequest
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
    public function rules(Request $request)
    {
        return [
            'title' => [
                'required',
                'string',
                'min:3',
                'max:45'
            ],
            'slug' => 'required|min:3|max:15'
            ];
    }
    public function messages() // должен быть
    {
        return[];
    }

    public function attributes()
    {
        return [
            'title' => 'Название категории',
            'slug' => 'Slug'
        ];
    }
}
