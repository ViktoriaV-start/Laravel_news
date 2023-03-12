<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class RegisterTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */

    public function testPassword()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                ->type('name', 'A')
                ->type('surname', 'A')
                ->type('email', 'aaa@aaa.net')
                ->type('password', '1')
                ->type('password_confirmation', '1')
                ->press('Зарегистрироваться')
                ->assertSee('Количество символов в поле пароль должно быть не меньше 3.');
        });
    }

    public function testPasswordConfirm()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                ->type('name', 'A')
                ->type('surname', 'A')
                ->type('email', 'aaa@aaa.net')
                ->type('password', '123')
                ->type('password_confirmation', '1234')
                ->press('Зарегистрироваться')
                ->assertSee('Значение поля пароль не совпадает с подтверждаемым.');
        });
    }

}
