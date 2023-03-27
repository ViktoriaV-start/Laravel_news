<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;
use App\Models\User;
use Laravel\Passport\Passport;


class SeeTest extends TestCase
{
    public function test_index()
    {
        $text = 'Новостной сайт Ньюс Лайн';

        $response = $this->get('https://www.sakura.test.ru');

        $response->assertSee($text);
    }

    public function test_an_action_that_requires_authentication() // ГОРЖУСЬ!
    {
//        $user = User::factory()->create();

        $user = User::factory()->create();
        $user['isAdmin'] = 1;

        $text = 'Редактирование профиля';

        $response = $this->actingAs($user)
            ->get('/profile');
        $response->assertSee($text);
        $user->delete(); // ЭТО УДАЛЕНИЕ СОЗДАННОГО ПОЛЬЗОВАТЕЛЯ ИЗ БД
    }

    public function test_admin_main_page()
    {
        $user = User::factory()->create();
        $user['is_admin'] = 1;
        dump($user['id']);

        $text = 'Администрирование';

//        Auth::login($user); ЭТОТ ВАРИАНТ ТАКЖЕ РАБОТАЕТ - здесь делаем авторизацию
//        $response = $this->get(route('admin.index'));

        $response = $this->actingAs($user)
            ->get('/admin');
        $response->assertSee($text);
        $user->delete(); // ЭТО УДАЛЕНИЕ СОЗДАННОГО ПОЛЬЗОВАТЕЛЯ ИЗ БД
    }

    public function test_admin_news_create()
    {
        $user = User::factory()->create();
        $user['is_admin'] = 1;
        dump($user['id']);

        $text = 'Добавить новость';

//        Auth::login($user); ЭТОТ ВАРИАНТ ТАКЖЕ РАБОТАЕТ - здесь делаем авторизацию
//        $response = $this->get(route('admin.index'));

        $response = $this->actingAs($user)
            ->get(route('admin.news.create'));
        $response->assertSee($text);
        $user->delete(); // ЭТО УДАЛЕНИЕ СОЗДАННОГО ПОЛЬЗОВАТЕЛЯ ИЗ БД
    }

    public function test_sport()
    {
        $text = 'Спорт';

        $response = $this->get('news/category/sport');

        $response->assertSee($text);
    }
}
