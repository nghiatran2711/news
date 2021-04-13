<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
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

Route::get('/', function () {
    return view('welcome');
});
Route::group(['prefix' => 'category', 'as' => 'category.'], function () {
    Route::get('/list', [CategoryController::class, 'index'])->name('index');
    Route::get('/show/{id}', [CategoryController::class, 'show'])->name('show');
});

Route::group(['prefix' => 'article', 'as' => 'article.'], function () {
    Route::get('/list', [ArticleController::class, 'index'])->name('index');
    Route::get('/create', [ArticleController::class, 'create'])->name('create');
    Route::post('/store', [ArticleController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [ArticleController::class, 'edit'])->name('edit');
    Route::put('/update/{id}', [ArticleController::class, 'update'])->name('update');
    Route::delete('/delete/{id}', [ArticleController::class, 'destroy'])->name('destroy');

});