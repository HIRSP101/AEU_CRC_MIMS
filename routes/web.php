<?php

use App\Http\Controllers\ProfileController;
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
$appC = "App\Http\Controllers";

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', "{$appC}\\DashboardController@index")
->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/logout', "{$appC}\\LogoutUserController@logout");

require __DIR__.'/auth.php';


Route::get('/test_db_connection', "{$appC}\\testdbconnection@testConnection");
Route::get('/initialmodels', "{$appC}\\testdbconnection@initialModelsSetup");
Route::get('/insertmember', "{$appC}\\testdbconnection@getMemberColumns");
Route::post('/insertmemberfr', "{$appC}\\testdbconnection@insertMember");
Route::post('/importdata', "{$appC}\\ImportController@import");
Route::get('/member',"{$appC}\\testdbconnection@eloquent_relation_delete");
Route::get("/deleteall", "{$appC}\\testdbconnection@deleteall_elo");
Route::get("/create", "{$appC}\\MemberController@index");
Route::post('/createmember', "{$appC}\\MemberController@insertMember");
Route::get('/uploadint', "{$appC}\\ResourceController@index");
Route::post('/uploadimage',"{$appC}\\ResourceController@uploadImage");
Route::get('/getallmembers', "{$appC}\\MemberController@getMemberDetail");
