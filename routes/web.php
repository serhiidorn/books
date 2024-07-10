<?php

use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::name('books.')->controller(BookController::class)->prefix('books')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/suggestions', 'suggestions')->name('suggestions');

    Route::middleware('auth')->group(function () {
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::post('/{book}/rates', 'rate')->name('rate');
        Route::post('/{book}/comments', 'comment')->name('comment');
    });

    Route::get('/{book}', 'show')->name('show');
});
