@extends('layouts.admin')

@section('title', 'Редактировать новости')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Редактировать новость</h1>
    </div>

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.news.update', $news) }}" enctype="multipart/form-data">
        @csrf
        @if ($news->id) @method('PUT') @endif

        <div class="form-group row mb-3">
            <label for="title" class="col-md-2 col-form-label text-md-end">Заголовок</label>

            <div class="col-md-8">
                <input id="title" type="text" class="form-control" name="title" value="{{ $news->title }}" autofocus>
            </div>

            {{--            Логика для ошибки: блок будет генерироваться в случае ошибки --}}
            @if($errors->has('title'))
                <div class="col-md-8 me-2 offset-md-2 alert alert-danger mt-3" role="alert">
                    @foreach($errors->get('title') as $error)
                        {{ $error }}
                    @endforeach
                </div>
            @endif
{{--            @error('title'){{ $message }} @enderror--}}

        </div>

        <div class="form-group row mb-3">
            <label for="category" class="col-md-2 col-form-label text-md-end">Категория новости</label>
            <div class="col-md-8">
                <select class="form-select" name="category_id" id="category">
                    @foreach($categories as $item)

                        <option

                            @if ($item->id == $news->category_id)
                            selected
                            @endif

                            value="{{ $item->id }}">

                            {{ $item->title }}

                        </option>
                    @endforeach
                </select>
            </div>
            {{--            Логика для ошибки: блок будет генерироваться в случае ошибки --}}
            @if($errors->has('category_id'))
                <div class="col-md-8 me-2 offset-md-2 alert alert-danger mt-3" role="alert">
                    @foreach($errors->get('category_id') as $error)
                        {{ $error }}
                    @endforeach
                </div>
            @endif
        </div>

        <div class="form-group row mb-3">
            <label for="status" class="col-md-2 col-form-label text-md-end">Статус</label>
            <div class="col-md-8">
                <select class="form-select" name="status" id="status">
                    <option @if($news->status === 'active') selected @endif value="active">active</option>
                    <option @if($news->status === 'blocked') selected @endif value="blocked">blocked</option>
                    <option @if($news->status === 'blocked') selected @endif value="blocked">draft</option>
                </select>
            </div>
            @if($errors->has('status'))
                <div class="col-md-8 me-2 offset-md-2 alert alert-danger mt-3" role="alert">
                    @foreach($errors->get('status') as $error)
                        {{ $error }}
                    @endforeach
                </div>
            @endif
        </div>

        <div class="form-group row mb-3">
            <label for="editor" class="col-md-2 col-form-label text-md-end">Текст новости</label>
            <div class="col-md-8">
                <textarea id="editor" type="text" class="form-control" name="text">{!! $news->text !!}</textarea>
            </div>
            @if($errors->has('text'))
                <div class="col-md-8 me-2 offset-md-2 alert alert-danger mt-3" role="alert">
                    @foreach($errors->get('text') as $error)
                        {{ $error }}
                    @endforeach
                </div>
            @endif
        </div>

        <div class="form-group row mb-3">
            <label for="newsPrivate" class="col-md-2 col-form-label text-md-end">Приватная</label>
            <div class="col-md-1">
                <input class="form-check-input mt-0-6"
                       @if ($news->isPrivate == 1) checked @endif
                       name="isPrivate" type="checkbox" value="1" id="newsPrivate">
            </div>
            @if($errors->has('isPrivate'))
                <div class="col-md-8 me-2 offset-md-2 alert alert-danger mt-3" role="alert">
                    @foreach($errors->get('isPrivate') as $error)
                        {{ $error }}
                    @endforeach
                </div>
            @endif
        </div>

        <div class="form-group row mb-3">
            <label for="image" class="col-md-2 col-form-label text-md-end">Добавить изображение</label>
            <div class="col-md-1">
                <input type="file" name="image">
            </div>
            @if($errors->has('image'))
                <div class="col-md-8 me-2 offset-md-2 alert alert-danger mt-3" role="alert">
                    @foreach($errors->get('image') as $error)
                        {{ $error }}
                    @endforeach
                </div>
            @endif
        </div>

        <div class="form-group row mb-0">
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group me-2 offset-md-2">
                    <button type="submit" class="btn btn-sm btn-outline-secondary btn-colored shadow-sm">Сохранить изменения</button>
                </div>
            </div>
        </div>

        </form>
@endsection

@push('js')
{{--    <script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/ckeditor.js"></script>--}}


{{--<script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/inline/ckeditor.js"></script>--}}

<script src="{{ asset('ckeditor5-build-classic/ckeditor.js') }}"></script>

<script>
    var options = {
        filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
        filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
        filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
        filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='

    };
</script>

<script>
    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            console.error( error );
        } );
</script>

@endpush

