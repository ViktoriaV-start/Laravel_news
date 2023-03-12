<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker;
use Illuminate\Support\Facades\DB;

class NewsSeeder extends Seeder
{

    public function run()
    {
        DB::table('news')->insert($this->getData()); // вставка в таблицу либо массива, либо одного значения
    }

    private function getData() {
        $data = [];
        $faker = Faker\Factory::create();
        for ($i = 1; $i<=25; $i++) {
            $data[] = [
                'category_id' => rand(1, 6),
                'title' => $faker->realText(10),
                'text' => $faker->realText(rand(200,700)),
                'image' => null
            ];
        }
        return $data;
    }
}
