<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layouts.main');
});
Route::get('/dokter', function () {
    return view('list-dokter');
});
Route::get('/obat', function () {
    return view('list-obat');
});
