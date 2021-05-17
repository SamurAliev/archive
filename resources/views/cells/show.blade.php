@extends('layout')
@section('breadcrumbs', Breadcrumbs::render())

@section('content')

    <div class="col-3">
        <a class="mt-2 mb-2 m-auto btn btn-success w-100" href="{{route('cells.edit', $cell)}}">Редактировать
            ячейку</a>
    </div>
    <div class="col-3">

        <form action="{{ route('cells.destroy', $cell)}}" method="POST">
            @method('DELETE')
            @csrf
            <button onclick="return confirm('Are you sure?')" type="submit" class="btn btn-danger w-100 mt-2 mb-2 m-auto">Удалить ячейку</button>
        </form>
    </div>

    <h1>Папки</h1>
    @foreach($folders as $folder)
        <div class="col-2">
            <a class="w-100 m-2 btn btn-secondary"
               href="{{route('folders.show', $folder)}}">{{$loop->iteration . '.' . ' ' . $folder->name}}</a>
        </div>
    @endforeach
    <div class="col-12">
        <a class="mt-2 mb-2 m-auto btn btn-primary w-auto" href="{{route('folders.create', 'cell_id=' . $cell->id)}}">Добавить папку</a>
    </div>
@endsection
