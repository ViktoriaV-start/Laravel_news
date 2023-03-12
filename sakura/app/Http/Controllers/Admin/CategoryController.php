<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index()
    {
        return view('admin.allCategories', [
            'categories' => Category::all()
        ]);
    }

    public function create()
    {
        return view('admin.category.create',[
            'categories' => Category::all()
        ]);
    }

    public function edit(Category $category)
    {
        return view('admin.category.edit',
            [
                'categories' => Category::all(),
                'category' => $category
            ]);
    }

    public function store(CategoryRequest $request, Category $category) {
        $request->flash();
        $request->validated();

        $saveStatus = $category->fill($request->all())->save();

        if ($saveStatus) {
            return redirect()->route('admin.category.index')->with('success', 'Категория успешно добавлена');
        }
        return back()->with('error', 'Ошибка при сохранении');
    }

    public function update(CategoryRequest $request, Category $category) {

        $request->validated();

        $saveStatus = $category->fill($request->all())->save();
        if ($saveStatus) {
            return redirect()->route('admin.category.index')->with('success', 'Категория изменена');
        }
        return back()->with('error', 'Ошибка при сохранении');
    }

    public function destroy(Category $category) {
        $category->delete();
        return redirect()->route('admin.category.index');
    }
}
