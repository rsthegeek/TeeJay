<?php

Route::get('/', function () {
    return view('welcome');
});

Route::resource('classes', 'ClassesController')->only(['index', 'show']);