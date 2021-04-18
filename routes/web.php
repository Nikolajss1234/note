<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get(
    '/',
    function () {
        return Inertia::render(
            'Welcome',
            [
                'canLogin' => Route::has('login'),
                'canRegister' => Route::has('register'),
                'laravelVersion' => Application::VERSION,
                'phpVersion' => PHP_VERSION,
            ]
        );
    }
);

Route::middleware(['auth:sanctum', 'verified'])->get(
    '/dashboard',
    function () {
        return Inertia::render('Dashboard');
    }
)->name('dashboard');


Route::group(
    ['namespace' => 'Notes', 'prefix' => 'notes', 'middleware' => ['auth:sanctum', 'verified']],
    function () {
        Route::get(
            '/',
            'NoteController@index'
        )->name('notes');

        Route::get(
            '/{id}',
            'NoteController@show'
        )->name('notes.show');

        Route::post(
            '/',
            'NoteController@create'
        )->name('notes.create');

        Route::put(
            '/{note}',
            'NoteController@update'
        )->name('notes.update');

        Route::delete(
            '/{note}',
            'NoteController@delete'
        )->name('notes.delete');
    }
);


