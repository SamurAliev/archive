@extends('layout')
@section('breadcrumbs', Breadcrumbs::render('files.show', $file))

@section('content')

    <div class="col-3">
        <a class="mt-2 mb-2 m-auto btn btn-success w-100" href="{{route('files.edit', $file)}}">Редактировать
            файл</a>
    </div>
    <div class="col-3">

        <form action="{{ route('files.destroy', $file)}}" method="POST">
            @method('DELETE')
            @csrf
            <button onclick="return confirm('Are you sure?')" type="submit" class="btn btn-danger w-100 mt-2 mb-2 m-auto">Удалить файл</button>
        </form>
    </div>

    <h1>Контент</h1>
        <div class="col-4">
            {{$file->content}}
        </div>
@endsection
