<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index() {
        return view('admin.index', [
            'categories' => Category::all()
        ]);
    }

// получение данных в виде JSON
    public function test1(News $news) {
        return response()->json($news->all())
            ->header('Content-Disposition', 'attachment; filename = "json.txt"') // для скачивания
            ->setEncodingOptions(JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT); // для отображения в браузере
    }

// скачать картинку
    public function test2() {
        return response()->download('img/4.jpg'); // скачать картинку
    }

    public function ajax() {
        return view('admin.ajax');
    }

    public function sendAjax(Request $request)
    {
        return response()->json([
            'id' => $request->id,
            'status' => 'ok'
        ]);
    }
}
