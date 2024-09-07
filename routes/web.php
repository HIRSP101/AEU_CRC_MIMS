<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('dashboard.index');
});
Route::get('/table_member',function(){
    return view('Branch_25Province.table_member');
});
Route::get('/list_province', function(){
    return view('Branch_25Province.list_province');
});
