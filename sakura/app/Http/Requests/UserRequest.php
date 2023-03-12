<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;

class UserRequest extends FormRequest
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
            'name' => 'required|string|max:15',
            'surname' => 'required|string|max:15',
            'email' => 'required|email|unique:users', // валидация для конкретного пользователя,
            'password' => 'required|string|min:3|confirmed'
        ];
    }

    public function messages()
    {
		return[];
    }

    public function attributes()
    {
        return [
            'name' => 'Имя',
            'surname' => 'Фамилия',
            'email' => 'Email', // валидация для конкретного пользователя,
            'password' => 'пароль'
        ];
    }


}
