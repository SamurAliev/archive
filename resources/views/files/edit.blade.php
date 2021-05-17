@extends('layout')
@section('breadcrumbs', Breadcrumbs::render())

@section('content')
    <h1>Форма редактирования файла</h1>
    <div class="col-5 mt-5">
        <form method="POST" action="{{route('files.update', $file)}}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Название</label>
                <input type="text" class="form-control" id="name" placeholder="Введите название" name="name" value="{{$file->name}}">
                @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="content">Контент</label>
                <textarea class="form-control" id="content" placeholder="Введите контент" name="content">{{$file->content}}</textarea>
                @error('content')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary d-block mt-5 m-auto">Редактировать</button>
        </form>

    </div>

@endsection
