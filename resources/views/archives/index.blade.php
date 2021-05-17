@extends('layout')
@section('breadcrumbs', Breadcrumbs::render())

@section('content')
        <h1>Архив-шкафы</h1>
        @foreach($archives as $archive)
        <div class="col-2">
            <a class="w-100 m-2 btn btn-secondary" href="{{route('archives.show', $archive)}}">{{$loop->iteration . '.' . ' ' . $archive->name}}</a>
        </div>
        @endforeach
        <div class="col-12">
            <a class="mt-2 mb-2 m-auto btn btn-success w-auto" href="{{route('archives.create')}}">Добавить</a>

        </div>
@endsection
