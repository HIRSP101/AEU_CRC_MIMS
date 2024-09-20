<?php

use App\Http\Controllers\ProfileController;
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

$appC = "App\Http\Controllers";

Route::get('/', function () {
    return view('welcome');
});


Route::middleware('auth')->group(function () use ($appC) {
    Route::get('/profile', "{$appC}\\ProfileController@edit")->name('profile.edit');
    Route::patch('/profile', "{$appC}\\ProfileController@update")->name('profile.update');
    Route::delete('/profile', "{$appC}\\ProfileController@destroy")->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])->group(function () use ($appC) {
    Route::get('/userroles', "{$appC}\\User\UserController@index")->name('userroles');
    Route::post('/storeregister', "{$appC}\\Auth\RegisteredUserController@store")->name('register.store');
    Route::post('/deleteuser', "{$appC}\\User\UserController@delete")->name('user.delete');
    Route::post('/edituser/{id}', "{$appC}\\User\UserController@edit")->name('user.edit');
    Route::post('/storeuser', "{$appC}\\User\UserController@store")->name('user.store');
    Route::get('/createuser', function () {
        return view('user.partials.createuser');
    });
});

Route::post('/logout', "{$appC}\\LogoutUserController@logout");

require __DIR__ . '/auth.php';

Route::middleware('auth')->group(function () use ($appC) {

    Route::get('/dashboard', "{$appC}\\DashboardController@index")
        ->middleware(['auth', 'verified'])->name('dashboard');
    Route::get('/test_db_connection', "{$appC}\\testdbconnection@testConnection");
    Route::get('/initialmodels', "{$appC}\\testdbconnection@initialModelsSetup");
    Route::get('/insertmember', "{$appC}\\testdbconnection@getMemberColumns")->name('import');
    Route::post('/insertmemberfr', "{$appC}\\testdbconnection@insertMember");
    Route::post('/importdata', "{$appC}\\ImportController@import");
    Route::get('/member', "{$appC}\\testdbconnection@eloquent_relation_delete");
    Route::get("/deleteall", "{$appC}\\testdbconnection@deleteall_elo");
    Route::get("/create", "{$appC}\\MemberController@index")->name('createmember');
    Route::post('/createmember', "{$appC}\\MemberController@insertMember");
    Route::get('/createbranch', "{$appC}\\BranchController@index")->name('createbranch');
    Route::get('/uploadint', "{$appC}\\ResourceController@index");
    Route::post('/uploadimage', "{$appC}\\ResourceController@uploadImage");
    Route::get('/getallmembers', "{$appC}\\MemberController@getMemberDetail");
});
