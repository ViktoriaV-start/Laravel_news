<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function update(Request $request) {

        $errors = [];
        $user = Auth::user();

        if ($request->isMethod('post')) {

            $this->validate($request, $this->validateRules(), [], $this->attributeNames());

            if (Hash::check($request->post('password'), $user->password)) {

                $user->fill([
                    'name' => $request->post('name'),
                    'surname' => $request->post('surname'),
                    'password' => Hash::make($request->post('newPassword')),
                    'email' => $request->post('email')
                ])->save();
                return redirect()->route('updateProfile')->withSuccess('Профиль успешно изменен!');
            } else {

                $errors['password'][] = 'Неверно введен текущий пароль';
                return redirect()->route('updateProfile')->withErrors($errors);
            }
        }

        return view('profile', [
            'categories' => Category::all(),
            'user' => $user
        ]);
    }

    protected function validateRules()
    {
        return [
            'name' => 'required|string|max:15',
            'surname' => 'required|string|max:15',
            'email' => 'required|email|unique:users,email,' . Auth::id(), // валидация для конкретного пользователя,
            // unique:users,email,' . Auth::id() - это передается id для обращения в БД
            'password' => 'required',
            'newPassword' => 'required|string|min:3|confirmed'
        ];
    }

    protected function attributeNames()
    {
        return [
            'newPassword' => 'Новый пароль'
        ];
    }
}
