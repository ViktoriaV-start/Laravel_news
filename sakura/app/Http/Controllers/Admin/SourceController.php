<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SourceRequest;
use App\Models\Source;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SourceController extends Controller
{
    public function index()
    {

        return view('admin.allSources', [
            'sources' => Source::all()
        ]);
    }

    public function create()
    {
        return view('admin.source.create');
    }

    public function store(SourceRequest $request, Source $source) {
        $request->flash();
        $request->validated();

        $saveStatus = $source->fill($request->all())->save();

        if ($saveStatus) {
            return redirect()->route('admin.source.index')->with('success', 'Ресурс успешно добавлен');
        }
        return back()->with('error', 'Ошибка при сохранении');
    }

    public function edit(Source $source)
    {
        return view('admin.source.edit',
            [
                'sources' => Source::all(),
                'source' => $source // передать экземпляр, который редактируется
            ]);
    }

    public function update(SourceRequest $request, Source $source) {

        $request->validated();

        $saveStatus = $source->fill($request->all())->save();
        if ($saveStatus) {
            return redirect()->route('admin.source.index')->with('success', 'Изменения сохранены');
        }
        return back()->with('error', 'Ошибка при сохранении');
    }

    public function destroy(Source $source) {
        $source->delete();
        return redirect()->route('admin.source.index');
    }
}
