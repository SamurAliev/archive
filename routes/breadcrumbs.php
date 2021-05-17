<?php


Breadcrumbs::for('home', function ($trail) {
    $trail->push('Главная', '/');
});

Breadcrumbs::for('archives.create', function ($trail) {
    $trail->parent('home');
    $trail->push('Новый архив', route('archives.create'));
});

Breadcrumbs::for('archives.show', function ($trail, $archive) {
    $trail->parent('home');
    $trail->push('Ячейки архив-шкафа ' . $archive->name, route('archives.show', $archive));
});

Breadcrumbs::for('archives.edit', function ($trail, $archive) {
    $trail->parent('home');
    $trail->push('Редактировать архив-шкаф ' . $archive->name, route('archives.edit', $archive));
});

Breadcrumbs::for('cells.show', function ($trail, $cell) {
    $archive = $cell->archive()->get()->first();
    $trail->parent('archives.show', $archive);
    $trail->push('Папки ячейки ' . $cell->name, route('cells.show', $cell));
});

Breadcrumbs::for('cells.create', function ($trail, $archive) {
    $trail->parent('archives.show', $archive);
    $trail->push('Создание новой ячейки', route('cells.create'));
});

Breadcrumbs::for('cells.edit', function ($trail, $cell) {
    $archive = $cell->archive()->get()->first();
    $trail->parent('archives.show', $archive);
    $trail->push('Редактирование ячейки ' . $cell->name, route('cells.show', $cell));
});

Breadcrumbs::for('folders.show', function ($trail, $folder) {
    $cell = $folder->cell()->first();
    $trail->parent('cells.show', $cell);
    $trail->push('Файлы папки ' . $folder->name, route('folders.show', $folder));
});

Breadcrumbs::for('folders.create', function ($trail, $cell) {
    $trail->parent('cells.show', $cell);
    $trail->push('Создание новой папки', route('folders.create'));
});
Breadcrumbs::for('folders.edit', function ($trail, $folder) {
    $cell = $folder->cell()->first();
    $trail->parent('cells.show', $cell);
    $trail->push('Редактирование папки ' . $folder->name, route('folders.edit', $folder));
});

Breadcrumbs::for('files.create', function ($trail, $folder) {
    $trail->parent('folders.show', $folder);
    $trail->push('Создание нового файла', route('files.create'));
});
Breadcrumbs::for('files.show', function ($trail, $file) {
    $folder = $file->folder()->first();
    $trail->parent('folders.show', $folder);
    $trail->push('Содержимое файла ' . $file->name, route('files.create'));
});
Breadcrumbs::for('files.edit', function ($trail, $file) {
    $folder = $file->folder()->first();
    $trail->parent('folders.show', $folder);
    $trail->push('Редактирование файла ' . $file->name, route('files.edit', $file));
});
