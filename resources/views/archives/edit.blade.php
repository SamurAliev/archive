@extends('layout')
@section('breadcrumbs', Breadcrumbs::render())

@section('content')
    <h1>Форма редактирования шкафа</h1>
    <div class="col-5 mt-5">
        <form method="POST" action="{{route('archives.update', $archive)}}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Название</label>
                <input type="text" class="form-control" id="name" placeholder="Введите название" name="name" value="{{$archive->name}}">
                @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary d-block mt-5 m-auto">Редактировать</button>
        </form>

    </div>

@endsection
