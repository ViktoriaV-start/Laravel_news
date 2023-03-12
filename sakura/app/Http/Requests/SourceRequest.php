<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class SourceRequest extends FormRequest
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
                'max:150'
            ],
            'source' => 'required|min:3|max:255'
        ];
    }
    public function messages() // должен быть
    {
        return[];
    }

    public function attributes()
    {
        return [
            'title' => 'Название ресурса',
            'source' => 'Адрес ресурса'
        ];
    }
}
