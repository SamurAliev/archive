@extends('layout')
@section('breadcrumbs', Breadcrumbs::render('folders.create', $cell))
@section('content')
    <h1>Форма добавления новой папки</h1>
    <div class="col-5 mt-5">
        <form method="POST" action="{{route('folders.store', 'cell_id=' . $cell->id)}}">
            @csrf
            <div class="form-group">
                <label for="name">Название</label>
                <input type="text" class="form-control" id="name" placeholder="Введите название" name="name" value="{{old('name')}}">
                @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary d-block mt-5 m-auto">Добавить</button>
        </form>

    </div>

@endsection
