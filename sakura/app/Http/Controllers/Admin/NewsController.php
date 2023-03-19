<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewsRequest;
use App\Models\Category;
use App\Models\News;
use App\Models\Source;
use App\Services\UploadService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    public function index() {
        return view('admin.allNews', [
            'news' => News::orderByDesc('created_at')->paginate(10),
//            'categories' => Category::all(),

            'categoriesTitle' => Category::query()->select(['id', 'title'])->get(), //???
            'sourcesTitle' => Source::query()->select(['id', 'title'])->get()
        ]);
    }

    public function create()
    {
        return view('admin.news.create', [
            'categories' => Category::all()
        ]);
    }

    public function store(NewsRequest $request, News $news) { // в этот роут можно попасть единственным путем, передав данные через post,
        // поэтому здесь не проверяем
        // $request->flash(); // метод фиксирует все данные от пользователя (сохраняются в одноразовую сессию),

        $request->validated();

        //$request->validate($news->rules(), [], $news->attributeNames()); // Это Валидация, при прохождении всех правил валидации в качестве
        //возвращаемого значения приходит массив из всех введенных значений. Поэтому можно при сохранении данных
        // вместо $request->all() подставить этот запрос на валидацию, но становится запутаннее.
        //$this->validate($request, $news->rules()); альтернативный вызов валидации

        $url = null;
        if ($request->file('image')) {

            $path = Storage::putFile('public/img', $request->file('image'));
            $url = Storage::url($path);

        }

        $news->fill($request->all());
        $news->image = $url;

       // $saveStatus = $news->fill($request->all())->save();
        $saveStatus = $news->save();

        if ($saveStatus) {
            return redirect()->route('news.one', $news->id)->with('success', 'Новость успешно добавлена');
        }
        return back()->with('error', 'Ошибка при сохранении');
    }

    public function edit(News $news)
    {


        return view('admin.news.edit',[
            'news' => $news,
            'categories' =>  Category::all()
        ]);
    }
//ПЕРВЫЙ МЕТОД УДАЛЕНИЯ
//    public function destroy(News $news): \Illuminate\Http\RedirectResponse
//    {
//        $news->delete();
//        return redirect()->route('admin.news.index');
//    }


//ВТОРОЙ АСИНХРОННЫЙ МЕТОД УДАЛЕНИЯ
    /**
     * @param News $news
     * @return JsonResponse
     */
    public function destroy(News $news): JsonResponse
    {
        try {
            $news->delete();
            return response()->json(['status' => 'ok']);

        } catch (\Exception $e) {
            \Log::error('News was not deleted');
            return response()->json(['status' => 'error'], 400);
        }
    }


    public function update(NewsRequest $request,News $news): \Illuminate\Http\RedirectResponse
    {

        $validated = $request->validated();
        // это будет массив с проверенными заполненными полями данными, которые пришли из формы

        if ($request->hasFile('image')) {
            $service = app(UploadService::class);
            $validated['image'] = $service->uploadFile($request->file('image')); // путь до файла, который мы загрузим в БД
        }

        $saveStatus = $news->fill($validated)->save();
        if ($saveStatus) {
            return redirect()->route('news.one', $news->id)->with('success', 'Новость изменена');
        }
        return back()->with('error', 'Ошибка обновления');
    }
}
