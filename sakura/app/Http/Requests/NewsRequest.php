<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class NewsRequest extends FormRequest
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
        // правила для валидации в Модели для данных из формы "Добавить Новость"
        // Данные в этой форме у меня приходят из инпутов по имени инпута
        // (name='title', плюс 'text', 'status', 'isPrivate', 'category_id', 'image'), смотрим их в Request.
    {
        return [
            'title' => 'required|min:5|max:150',
            'text' => 'required|min:5|max:1500',
            'status' => [
                'required',
                Rule::in(['active', 'blocked', 'draft']) // такой синтаксис для правила in
            ],

            'isPrivate' => 'sometimes|in:1',

            'category_id' => 'required|exists:App\Models\Category,id', // ВНИМАНИЕ: здесь происходит вставка модели,
            // проверка на существование
            // здесь exists проверит так: полученное значение 'category_id' должно содержаться в столбце id в таблице categories в БД,


            'image' => 'dimensions:min_width=100,min_height=200|mimes:jpeg,bmp,phg|max:1000',
        ];
    }

    public function messages() // должен быть
    {
        return[];

    }

    public function attributes()
    {
        return [
            'title' => 'Заголовок новости',
            'text' => 'Текст новости',
            'category_id' => 'Категория новости',
            'status' => 'Статус',
            'image' => 'Изображение'
        ];
    }
}
