@extends('layout')
@section('breadcrumbs', Breadcrumbs::render('files.create', $folder))
@section('content')
    <h1>Форма добавления нового файла</h1>
    <div class="col-5 mt-5">
        <form method="POST" action="{{route('files.store', 'folder_id=' . $folder->id)}}">
            @csrf
            <div class="form-group">
                <label for="name">Название</label>
                <input type="text" class="form-control" id="name" placeholder="Введите название" name="name" value="{{old('name')}}">
                @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="content">Контент</label>
                <textarea class="form-control" id="content" placeholder="Введите контент" name="content">{{old('content')}}</textarea>
                @error('content')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary d-block mt-5 m-auto">Добавить</button>
        </form>

    </div>

@endsection
