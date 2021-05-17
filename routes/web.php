<?php

use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\CellController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\FolderController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [ArchiveController::class, 'index'])->name('home');

Route::resource('/archives', ArchiveController::class);
Route::resource('/cells', CellController::class);
Route::resource('/folders', FolderController::class);
Route::resource('/files', FileController::class);

