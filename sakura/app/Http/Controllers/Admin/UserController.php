<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index() {
        return view('admin.allUsers', [
            'users' => User::query()->where('id', '!=', Auth::id())->get(),
            // это запрос на вывод всех пользователей, кроме самого администратора
            'categories' => Category::all(),
        ]);
    }

    public function destroy(User $user) {
        $user->delete();
        return redirect()->route('admin.user.index');
    }

    public function update(Request $request, User $user) {

        // !$user->is_admin === true ? $user->is_admin=true : $user->is_admin=false;
        $user->is_admin = !$user->is_admin; // альтернативная запись изменения состояния true на falsec

        $saveStatus = $user->save();

        if ($saveStatus) {
            return redirect()->route('admin.user.index');
        }
        // return back()->with('error', 'Ошибка при сохранении');
        return back()->withError('Ошибка при сохранении');
    }

}
