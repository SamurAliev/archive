@extends('layout')
@section('breadcrumbs', Breadcrumbs::render('folders.show', $folder))

@section('content')

    <div class="col-3">
        <a class="mt-2 mb-2 m-auto btn btn-success w-100" href="{{route('folders.edit', $folder)}}">Редактировать
            папку</a>
    </div>
    <div class="col-3">

        <form action="{{ route('folders.destroy', $folder)}}" method="POST">
            @method('DELETE')
            @csrf
            <button onclick="return confirm('Are you sure?')" type="submit" class="btn btn-danger w-100 mt-2 mb-2 m-auto">Удалить папку</button>
        </form>
    </div>

    <h1>Файлы</h1>
    @foreach($files as $file)
        <div class="col-2">
            <a class="w-100 m-2 btn btn-secondary"
               href="{{route('files.show', $file)}}">{{$loop->iteration . '.' . ' ' . $file->name}}</a>
        </div>
    @endforeach
    <div class="col-12">
        <a class="mt-2 mb-2 m-auto btn btn-primary w-auto" href="{{route('files.create', 'folder_id=' . $folder->id)}}">Добавить файл</a>
    </div>
@endsection
