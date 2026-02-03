<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;

Route::get('/', function () {
    return redirect()->route('authors.index');
});

// Author Routes
Route::resource('authors', AuthorController::class);

// Book Routes
Route::resource('books', BookController::class);
