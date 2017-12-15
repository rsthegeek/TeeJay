<?php

Route::get('/', function () {
    return view('welcome');
});

Route::resource('classes', 'ClassesController')->only(['index', 'show']);
Route::resource('courses', 'CoursesController')->only(['index', 'show']);
Route::resource('teachers', 'TeachersController')->only(['index', 'show']);
Route::resource('complexes', 'ComplexesController')->only(['index', 'show']);