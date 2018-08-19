<?php



Route::get('/', function () { return view('layouts.homepage');});
Route::resource('tasks','TasksController');
Route::resource('archive' , 'TasksController')->only(['index']);
Route::resource('tasks/{task}/comments', 'CommentsController')->only(['store', 'update', 'destroy']);
Auth::routes();

