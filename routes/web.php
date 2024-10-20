<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\DataChatController;
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

Route::get('/', function () {
    return view('dashboard.index')-> name('dashboard');
});

$appController = "App\Http\Controllers";


// Insert Member Route
Route::controller(MemberController::class)->group(function() {
    Route::get('/', 'home');
    Route::get('/detail/{id}', 'details');
    Route::get('/create', 'create')->name('create-member');
    Route::post('/add-member', 'addmember')->name('addmember');
});


//All Reports Route
Route::controller(ReportController::class)->group(function() {
    Route::get('/reports', 'index')->name('report-page');
    Route::get("/data-chart", 'data_chart')->name('data-chart');
    Route::get("/branch", "branch")->name('branch');
    Route::get("/list-of-name", 'listOfName')->name('list-of-name');
});


Route::get("/provinces","{$appController}\\ProvincesController@index")->name('provinces');
Route::get("/table_member","{$appController}\\ProvincesController@table_member")->name('table_member');

