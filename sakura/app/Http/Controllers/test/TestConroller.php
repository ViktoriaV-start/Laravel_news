<?php

namespace App\Http\Controllers\test;

use App\Http\Controllers\Controller;
use Faker\Factory;
use Illuminate\Http\Request;

class TestConroller extends Controller
{
    public function index () {

        $faker = Factory::create();
        $status = ['draft', 'active', 'blocked'];

        $data = [];
        for($i=1; $i <= 10; $i++) {
            $data[$i] = [
                'id' => $i,
                'title' => $faker->company(),
                'status' => $status[mt_rand(0, 2)],
                'text' => $faker->text(150),
                'image' => $faker->imageUrl(100, 80),
                'some' => $faker->emoji(),
            ];
        }


        $array = \Arr::add(['name' => 'Desk', 'price' => null], 'price', 100);
        $array1 = \Arr::add(['name' => 'Table'], 'price', 1000);
        dump($array, $array1);

        return view('test.index')->with('news', $data);
    }

    public function info () {
        return view('test.info');
    }

}



