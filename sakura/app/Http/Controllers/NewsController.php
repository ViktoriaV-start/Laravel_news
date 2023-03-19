<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\News;
use Illuminate\Support\Facades\Log;

class NewsController extends Controller
{
    public function index() {
        $news = News::paginate(10);

        return view('news.index', [
            'news' => $news
        ]);
    }


    public function show(int $id)
    {
        //$news = DB::select('SELECT * FROM `news` WHERE id = :id', ['id' => $id]);
//            $news = DB::table('news')->find($id); //getOne($id)
        $news = News::find($id);
//        Log::info('I4445566'); // сделать запись в log

//        return view('news.one', [
//                'news' => $news
//            ]);


        if ($news) {
            return view('news.one', [
                'news' => $news
            ]);
        } else {
            return back()->with('error', 'Новость не найдена');
            //withError('Ошибка при сохранении'); // такой вариант также подходит
        }
    }

}
