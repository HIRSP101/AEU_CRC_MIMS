<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ReportController;
use SebastianBergmann\CodeCoverage\Report\Xml\Report;

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

// Route::get('/', function () {
//     return view('dashboard.index')-> name('dashboard');
// });

$appC = "App\Http\Controllers";


Route::get("/", "{$appC}\\MemberController@home")->name('dashboard');
Route::get('/detail/{id}', "{$appC}\\MemberController@details");
Route::get("/create", "{$appC}\\MemberController@create")->name('create-member');
Route::post("/create", "{$appC}\\MemberController@addmember")->name('addmember');

Route::get("/provinces","{$appC}\\ProvincesController@index")->name('provinces');
Route::get("/table_member","{$appC}\\ProvincesController@table_member")->name('table_member');

Route::get("/report", "{$appC}\\ReportController@index")->name('report-page');