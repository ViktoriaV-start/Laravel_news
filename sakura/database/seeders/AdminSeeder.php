<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('users')->insert($this->getData());
    }

    private function getData() {
        return [
            [
                'name' => 'admin',
                'surname' => 'Иванов',
                'email' => 'admin@admin.ru',
                'password' => Hash::make(123),
                'remember_token' => Str::random(10),
                'is_admin' => true
            ]

        ];
    }
}

