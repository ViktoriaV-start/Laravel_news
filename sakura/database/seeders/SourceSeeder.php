<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sources')->insert(
            [
                ['title' => 'NewsLine',
                'source' => 'Новостной сайт НьюсЛайн'],

                ['title' => 'lenta.ru',
                 'source' => 'https://lenta.ru/rss/news'],

                ['title' => 'yandex.music',
                'source' => 'https://news.yandex.ru/music.rss'],
            ]

        );
    }
}
