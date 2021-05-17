@extends('layout')
@section('breadcrumbs', Breadcrumbs::render())

@section('content')
    <div class="col-3">
        <a class="mt-2 mb-2 m-auto btn btn-success w-100" href="{{route('archives.edit', $archive)}}">Редактировать
            архив-шкаф</a>
    </div>
    <div class="col-3">

        <form action="{{ route('archives.destroy', $archive)}}" method="POST">
            @method('DELETE')
            @csrf
            <button onclick="return confirm('Are you sure?')" type="submit" class="btn btn-danger w-100 mt-2 mb-2 m-auto">Удалить архив-шкаф</button>
        </form>
    </div>

    <h1>Ячейки</h1>
    @foreach($cells as $cell)
        <div class="col-2">
            <a class="w-100 m-2 btn btn-secondary"
               href="{{route('cells.show', $cell)}}">{{$loop->iteration . '.' . ' ' . $cell->name}}</a>
        </div>
    @endforeach
    <div class="col-12">
        <a class="mt-2 mb-2 m-auto btn btn-primary w-auto" href="{{route('cells.create', 'archive_id=' . $archive->id)}}">Добавить ячейку</a>
    </div>
@endsection
